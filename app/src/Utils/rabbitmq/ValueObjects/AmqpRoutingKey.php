<?php

declare(strict_types = 1);

namespace App\src\Utils\rabbitmq\ValueObjects;

use App\src\Utils\rabbitmq\Exceptions\InvalidAmqpRoutingKey;

final class AmqpRoutingKey
{
    public const ALLOWED_ROUTING_KEY_PATTERN = '/\w[.]\w/';
    private string $routingKey;

    /**
     * @throws InvalidAmqpRoutingKey
     */
    public function __construct(string $routingKey)
    {
        $this->assertRoutingKeyValid($routingKey);
        $this->routingKey = $routingKey;
    }

    public function getRoutingKey(): string
    {
        return $this->routingKey;
    }

    /**
     * @throws InvalidAmqpRoutingKey
     */
    private function assertRoutingKeyValid(string $routingKey): void
    {
        if (preg_match(self::ALLOWED_ROUTING_KEY_PATTERN, $routingKey) === 0) {
            throw InvalidAmqpRoutingKey::invalidRoutingKey($routingKey);
        }
    }
}
