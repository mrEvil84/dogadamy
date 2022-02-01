<?php

declare(strict_types = 1);

namespace App\src\Utils\rabbitmq\ValueObjects;

use App\src\Utils\rabbitmq\Exceptions\InvalidExchangeType;

final class AmqpExchangeSettings
{
    public const ALLOWED_EXCHANGE_TYPE = [
        AmqpExchangeType::TOPIC,
        AmqpExchangeType::DIRECT,
        AmqpExchangeType::FANOUT,
    ];

    private string $exchangeName;
    private string $exchangeType;
    private bool $passive;
    private bool $durable;
    private bool $autoDelete;

    /**
     * @throws InvalidExchangeType
     */
    public function __construct(
        string $exchangeName,
        string $exchangeType,
        bool $passive,
        bool $durable,
        bool $autoDelete
    ) {
        $this->assertExchangeType($exchangeType);

        $this->exchangeName = $exchangeName;
        $this->exchangeType = $exchangeType;
        $this->passive = $passive;
        $this->durable = $durable;
        $this->autoDelete = $autoDelete;
    }

    public function getExchangeName(): string
    {
        return $this->exchangeName;
    }

    public function getExchangeType(): string
    {
        return $this->exchangeType;
    }

    public function isPassive(): bool
    {
        return $this->passive;
    }

    public function isDurable(): bool
    {
        return $this->durable;
    }

    public function isAutoDelete(): bool
    {
        return $this->autoDelete;
    }

    /**
     * @throws InvalidExchangeType
     */
    private function assertExchangeType(string $exchangeType): void
    {
        if (!in_array($exchangeType, self::ALLOWED_EXCHANGE_TYPE, true)) {
            throw InvalidExchangeType::invalidExchangeType($exchangeType);
        }
    }
}
