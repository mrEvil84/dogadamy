<?php

namespace App\src\Utils\rabbitmq\Exceptions;

class InvalidAmqpRoutingKeys extends \Exception
{
    public static function invalidRoutingKeysCount(): self
    {
        return new self('Invalid routing keys count. Only one accepted.');
    }
}
