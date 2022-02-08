<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Utils\rabbitmq\AmqpConsumer;
use PhpAmqpLib\Message\AMQPMessage;

class PelletAmqpConsumer extends AmqpConsumer
{
    public static function getInstance(): AmqpConsumer
    {
        // TODO: Implement getInstance() method.
    }

    public static function process(AMQPMessage $message): void
    {
        // TODO: Implement process() method.
    }

}
