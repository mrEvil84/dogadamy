<?php

namespace App\src\Utils\rabbitmq;

use App\src\Utils\rabbitmq\ValueObjects\AmqpConnectionSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpMessageDeliveryMode;
use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKey;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class AmqpPublisher
{
    private AmqpConnectionSettings $connectionSettings;
    private AmqpExchangeSettings $exchangeSettings;

    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;

    private AmqpRoutingKey $routingKey;
    private AmqpMessageDeliveryMode $messageDeliveryMode;

    public function __construct(
        AmqpConnectionSettings $connectionSettings,
        AmqpExchangeSettings $exchangeSettings,
        AmqpMessageDeliveryMode $messageDeliveryMode,
        AmqpRoutingKey $routingKey
    ) {
        $this->connectionSettings = $connectionSettings;
        $this->exchangeSettings = $exchangeSettings;
        $this->messageDeliveryMode = $messageDeliveryMode;
        $this->routingKey = $routingKey;
    }

    abstract public static function getInstance(): self;

    final public function publish(string $message): void
    {
        $this->setConnection();
        $this->channel = $this->connection->channel();
        $this->setExchange();

        $message = new AMQPMessage(
            $message,
            ['delivery_mode' => $this->messageDeliveryMode->getDeliveryMode()]
        );

        $this->channel->basic_publish(
            $message,
            $this->exchangeSettings->getExchangeName(),
            $this->routingKey->getRoutingKey()
        );

        $this->channel->close();
        $this->connection->close();
    }

    private function setConnection(): void
    {
        $this->connection = new AMQPStreamConnection(
            $this->connectionSettings->getHost(),
            $this->connectionSettings->getPort(),
            $this->connectionSettings->getUser(),
            $this->connectionSettings->getPassword()
        );
    }

    private function setExchange(): void
    {
        $this->channel->exchange_declare(
            $this->exchangeSettings->getExchangeName(),
            $this->exchangeSettings->getExchangeType(),
            $this->exchangeSettings->isPassive(),
            $this->exchangeSettings->isDurable(),
            $this->exchangeSettings->isAutoDelete()
        );
    }
}
