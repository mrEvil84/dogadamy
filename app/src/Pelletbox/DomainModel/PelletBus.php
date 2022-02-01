<?php

declare(strict_types = 1);

namespace App\src\Pelletbox\DomainModel;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;

interface PelletBus
{
    public function consumeUnit(Unit $unit, \DateTime $consumedAt): void;
}
