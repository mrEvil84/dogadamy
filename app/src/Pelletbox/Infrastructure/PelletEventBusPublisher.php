<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\PelletBusPublisher;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;

class PelletEventBusPublisher implements PelletBusPublisher
{
    public function publishConsumeUnit(Unit $unit, \DateTime $consumedAt): void
    {
        event(
            new UnitConsumed($unit, $consumedAt)
        );
    }
}
