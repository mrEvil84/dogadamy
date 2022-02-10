<?php

namespace App\src\Utils\rabbitmq;

use App\src\Utils\rabbitmq\ValueObjects\AmqpConnectionSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpExchangeSettings;
use App\src\Utils\rabbitmq\ValueObjects\AmqpMessageDeliveryMode;
use App\src\Utils\rabbitmq\ValueObjects\AmqpRoutingKeys;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class AmqpBase
{
    protected AmqpConnectionSettings $connectionSettings;
    protected AmqpExchangeSettings $exchangeSettings;

    protected AMQPStreamConnection $connection;
    protected AMQPChannel $channel;

    protected AmqpRoutingKeys $routingKeys;
    protected AmqpMessageDeliveryMode $messageDeliveryMode;

    public function __construct(
        AmqpConnectionSettings $connectionSettings,
        AmqpExchangeSettings $exchangeSettings,
        AmqpMessageDeliveryMode $messageDeliveryMode,
        AmqpRoutingKeys $routingKeys
    ) {
        $this->connectionSettings = $connectionSettings;
        $this->exchangeSettings = $exchangeSettings;
        $this->messageDeliveryMode = $messageDeliveryMode;
        $this->routingKeys = $routingKeys;
    }

    protected function setConnection(): void
    {
        $this->connection = new AMQPStreamConnection(
            $this->connectionSettings->getHost(),
            $this->connectionSettings->getPort(),
            $this->connectionSettings->getUser(),
            $this->connectionSettings->getPassword()
        );
    }

    protected function setExchange(): void
    {
        $this->channel->exchange_declare(
            $this->exchangeSettings->getExchangeName(),
            $this->exchangeSettings->getExchangeType(),
            $this->exchangeSettings->isPassive(),
            $this->exchangeSettings->isDurable(),
            $this->exchangeSettings->isAutoDelete()
        );
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
