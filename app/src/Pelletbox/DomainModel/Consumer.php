<?php

declare(strict_types=1);

namespace App\src\Pelletbox\DomainModel;

use PhpAmqpLib\Message\AMQPMessage;

interface Consumer
{
    public function consumeMessage(string $queueName): void;
}
