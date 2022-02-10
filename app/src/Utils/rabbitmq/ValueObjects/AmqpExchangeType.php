<?php

namespace App\src\Utils\rabbitmq\ValueObjects;

final class AmqpExchangeType
{
    public const TOPIC = 'topic';
    public const DIRECT = 'direct';
    public const FANOUT = 'fanout';
}
