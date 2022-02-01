<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Utils\rabbitmq\AmqpPublisher;
use App\src\Utils\rabbitmq\Exceptions\InvalidAmqpRoutingKey;
use App\src\Utils\rabbitmq\Exceptions\InvalidExchangeType;
use App\src\Utils\rabbitmq\ValueObjects\AmqpConnectionSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeType;
use App\src\Utils\rabbitmq\ValueObjects\AmqpMessageDeliveryMode;
use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKey;
use PhpAmqpLib\Message\AMQPMessage;

class PelletAmqpPublisher extends AmqpPublisher
{
    /**
     * @throws InvalidExchangeType
     * @throws InvalidAmqpRoutingKey
     */
    public static function getInstance(): AmqpPublisher
    {
        $connectionSettings = new AmqpConnectionSettings(
            host: env('AMQP_HOST', 'localhost'),
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

        $routingKey = new AmqpRoutingKey(routingKey: env('PELLET_CONSUME_QUEUE', 'pellet.consumed'));
        $messageDeliveryMode = new AmqpMessageDeliveryMode(AMQPMessage::DELIVERY_MODE_PERSISTENT);

        return new self(
            $connectionSettings,
            $exchangeSettings,
            $messageDeliveryMode,
            $routingKey
        );
    }
}
