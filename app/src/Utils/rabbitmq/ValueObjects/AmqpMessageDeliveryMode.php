<?php

namespace App\src\Utils\rabbitmq\ValueObjects;

use App\src\Utils\rabbitmq\Exceptions\InvalidAmqpMessageDeliveryMode;
use PhpAmqpLib\Message\AMQPMessage;

final class AmqpMessageDeliveryMode
{
    private int $deliveryMode;

    public const ACCEPTED_DELIVERY_MODE = [AMQPMessage::DELIVERY_MODE_PERSISTENT];

    /**
     * @throws InvalidAmqpMessageDeliveryMode
     */
    public function __construct(int $deliveryMode)
    {
        $this->assertDeliveryMode($deliveryMode);
        $this->deliveryMode = $deliveryMode;
    }

    public function getDeliveryMode(): int
    {
        return $this->deliveryMode;
    }

    /**
     * @throws InvalidAmqpMessageDeliveryMode
     */
    private function assertDeliveryMode(int $deliveryMode): void
    {
        if (!in_array($deliveryMode, self::ACCEPTED_DELIVERY_MODE, true)) {
            throw InvalidAmqpMessageDeliveryMode::invalidMessageDeliveryMode($deliveryMode);
        }
    }
}
