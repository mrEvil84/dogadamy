<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\PelletBus;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;

class PelletEventBus implements PelletBus
{
    public function consumeUnit(Unit $unit, \DateTime $consumedAt): void
    {
        event(
            new UnitConsumed($unit, $consumedAt)
        );
    }
}
