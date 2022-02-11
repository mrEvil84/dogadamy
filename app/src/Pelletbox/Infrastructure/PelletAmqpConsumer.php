<?php

declare(strict_types=1);

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Consumer;
use App\src\Utils\rabbitmq\AmqpConsumer;
use App\src\Utils\rabbitmq\AmqpConsumerProcessor;
use App\src\Utils\rabbitmq\ValueObjects\AmqpConnectionSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeType;
use App\src\Utils\rabbitmq\ValueObjects\AmqpMessageDeliveryMode;
use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKey;
use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKeys;
use ErrorException;
use PhpAmqpLib\Message\AMQPMessage;

class PelletAmqpConsumer extends AmqpConsumer implements Consumer
{
    private AmqpConsumerProcessor $consumerProcessor;

    /**
     * @param AmqpConsumerProcessor $consumerProcessor
     */
    public function __construct(
        AmqpConnectionSettings $connectionSettings,
        AmqpExchangeSettings $exchangeSettings,
        AmqpMessageDeliveryMode $messageDeliveryMode,
        AmqpRoutingKeys $routingKeys,
        AmqpConsumerProcessor $consumerProcessor
    ) {
        parent::__construct(
            $connectionSettings,
            $exchangeSettings,
            $messageDeliveryMode,
            $routingKeys
        );
        $this->consumerProcessor = $consumerProcessor;
    }


    public static function getInstance(AmqpConsumerProcessor $consumerProcessor): self {

        $connectionSettings = new AmqpConnectionSettings(
            host: env('AMQP_HOST'),
            port: (int)env('AMQP_PORT', 5672),
            user: env('AMQP_USER', 'msgProducer'),
            password: env('AMQP_USER_PASS', 'secret')
        );

        $exchangeSettings = new AmqpExchangeSettings(
            env('PELLET_EXCHANGE_NAME', 'pellet'),
            AmqpExchangeType::TOPIC,
            false,
            true,
            false
        );

        $routingKey = new AmqpRoutingKey(routingKey: env('PELLET_CONSUME_QUEUE_ROUTE', 'pellet.consumed'));
        $routingKeys = new AmqpRoutingKeys([$routingKey]);
        $messageDeliveryMode = new AmqpMessageDeliveryMode(AMQPMessage::DELIVERY_MODE_PERSISTENT);

        return new self(
            $connectionSettings,
            $exchangeSettings,
            $messageDeliveryMode,
            $routingKeys,
            $consumerProcessor
        );
    }

    public function process(AMQPMessage $message): void
    {
        $this->consumerProcessor->process($message);
    }

    /**
     * @throws ErrorException
     */
    public function consumeMessage(string $queueName): void
    {
        $this->consume($queueName);
    }
}
