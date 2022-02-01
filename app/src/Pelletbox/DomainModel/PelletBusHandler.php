<?php
// todo: https://bulldogjob.pl/articles/122-cqrs-i-event-sourcing-czyli-latwa-droga-do-skalowalnosci-naszych-systemow_
declare(strict_types = 1);

namespace App\src\Pelletbox\DomainModel;

use App\src\Pelletbox\DomainModel\Events\UnitConsumed;

interface PelletBusHandler
{
    public function consumeUnit(UnitConsumed $unitConsumed): void;
}
