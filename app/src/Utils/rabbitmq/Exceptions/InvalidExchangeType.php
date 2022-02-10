<?php

namespace App\src\Utils\rabbitmq\Exceptions;

class InvalidExchangeType extends \Exception
{
    public static function invalidExchangeType(string $type): self
    {
        return new self('Invalid exchange type : ' . $type);
    }
}
