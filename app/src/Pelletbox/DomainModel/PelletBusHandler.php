<?php

// todo: https://bulldogjob.pl/articles/122-cqrs-i-event-sourcing-czyli-latwa-droga-do-skalowalnosci-naszych-systemow_

declare(strict_types = 1);

namespace App\src\Pelletbox\DomainModel;

use App\src\Pelletbox\DomainModel\Events\PelletStatsCached;
use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;

interface PelletBusHandler
{
    public function handleConsumeUnit(UnitConsumed $unitConsumed): void;
    public function handleStatsCached(PelletStatsCached $statsCached):void;
}
