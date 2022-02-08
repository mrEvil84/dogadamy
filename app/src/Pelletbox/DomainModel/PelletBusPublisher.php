<?php

declare(strict_types = 1);

namespace App\src\Pelletbox\DomainModel;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;

interface PelletBusPublisher
{
    public function publishConsumeUnit(Unit $unit, \DateTime $consumedAt): void;
}
