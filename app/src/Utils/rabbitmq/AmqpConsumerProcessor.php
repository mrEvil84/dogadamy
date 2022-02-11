<?php

namespace App\src\Utils\rabbitmq;

use PhpAmqpLib\Message\AMQPMessage;

interface AmqpConsumerProcessor
{
    public function process(AMQPMessage $message): void;
}
