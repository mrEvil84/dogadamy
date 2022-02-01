<?php

declare(strict_types = 1);

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\PelletBusHandler;
use App\src\Utils\rabbitmq\AmqpPublisher;
use JsonException;

class  PelletEventBusHandler implements PelletBusHandler
{
    private AmqpPublisher $publisher;

    public function __construct(AmqpPublisher $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @throws JsonException
     */
    public function consumeUnit(UnitConsumed $unitConsumed): void
    {
        $this->publisher->publish($unitConsumed->getJsonEncoded());
    }
}
