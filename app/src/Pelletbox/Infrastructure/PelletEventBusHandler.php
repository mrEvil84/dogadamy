<?php

declare(strict_types = 1);

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\PelletBusHandler;
use App\src\Utils\rabbitmq\AmqpPublisher;
use JsonException;

class PelletEventBusHandler implements PelletBusHandler
{
    private AmqpPublisher $amqpPublisher;

    public function __construct(AmqpPublisher $amqpPublisher)
    {
        $this->amqpPublisher = $amqpPublisher;
    }

    /**
     * @throws JsonException
     */
    public function handleConsumeUnit(UnitConsumed $unitConsumed): void
    {
        $this->amqpPublisher->publish($unitConsumed->getJsonEncoded());
    }
}
