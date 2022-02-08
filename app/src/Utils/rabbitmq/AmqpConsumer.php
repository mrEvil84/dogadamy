<?php

namespace App\src\Utils\rabbitmq;

use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKey;
use ErrorException;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;

// a template method

abstract class AmqpConsumer extends AmqpBase
{
    abstract public static function getInstance(): self;

    abstract public static function process(AMQPMessage $message): void;

    /**
     * @throws ErrorException
     * @throws Exception
     */
    final public function consume(): void
    {
        $this->setConnection();
        $this->channel = $this->connection->channel();
        $this->setExchange();

        [$queueName, ,] = $this->channel->queue_declare("", false, true, true, false);

        /** @var AmqpRoutingKey $routingKey */
        foreach ($this->routingKeys as $routingKey) {
            $this->channel->queue_bind(
                $queueName,
                $this->exchangeSettings->getExchangeName(),
                $routingKey->getKey()
            );
        }

        $this->channel->basic_consume(
            $queueName,
            '',
            false,
            false,
            false,
            false,
            [$this, 'process']
        );

        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }

        $this->channel->close();
        $this->connection->close();
    }
}