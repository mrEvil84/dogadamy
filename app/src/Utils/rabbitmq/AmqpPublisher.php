<?php

namespace App\src\Utils\rabbitmq;

use App\src\Utils\rabbitmq\Exceptions\InvalidAmqpRoutingKeys;
use App\src\Utils\rabbitmq\ValueObjects\AmqpConnectionSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpMessageDeliveryMode;
use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKeys;
use Exception;
use PhpAmqpLib\Message\AMQPMessage;

abstract class AmqpPublisher extends AmqpBase
{
    /**
     * @throws InvalidAmqpRoutingKeys
     */
    public function __construct(
        AmqpConnectionSettings $connectionSettings,
        AmqpExchangeSettings $exchangeSettings,
        AmqpMessageDeliveryMode $messageDeliveryMode,
        AmqpRoutingKeys $routingKeys
    ) {
        if ($routingKeys->count() !== 1) {
            throw InvalidAmqpRoutingKeys::invalidRoutingKeysCount();
        }
        parent::__construct(
            $connectionSettings,
            $exchangeSettings,
            $messageDeliveryMode,
            $routingKeys
        );
    }

    abstract public static function getInstance(): self;

    /**
     * @throws Exception
     */
    final public function publish(string $msg): void
    {
        $this->setConnection();
        $this->channel = $this->connection->channel();
        $this->setExchange();

        $message = new AMQPMessage(
            $msg,
            [
                'delivery_mode' => $this->messageDeliveryMode->getDeliveryMode()
            ]
        );

        $this->channel->basic_publish(
            $message,
            $this->exchangeSettings->getExchangeName(),
            $this->routingKeys->offsetGet(0)
        );

        $this->channel->close();
        $this->connection->close();
    }
}
