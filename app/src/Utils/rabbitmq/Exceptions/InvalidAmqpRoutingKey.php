<?php

namespace App\src\Utils\rabbitmq\Exceptions;

class InvalidAmqpRoutingKey extends \Exception
{
    public static function routingKeyNotSet(): self
    {
        return new self('Routing key not set.');
    }

    public static function invalidRoutingKey(string $routingKey): self
    {
        return new self('Routing key invalid: ' . $routingKey);
    }
}
