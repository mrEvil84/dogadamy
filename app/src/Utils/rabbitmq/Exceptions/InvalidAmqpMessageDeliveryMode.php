<?php

namespace App\src\Utils\rabbitmq\Exceptions;

class InvalidAmqpMessageDeliveryMode extends \Exception
{
    public static function messageDeliveryModeNotSet(): self
    {
        return new self('Message delivery mode not set.');
    }

    public static function invalidMessageDeliveryMode(int $deliveryMode): self
    {
        return new self('Invalid amqp delivery mode. : ' . $deliveryMode);
    }
}
