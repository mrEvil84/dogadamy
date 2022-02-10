<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use Illuminate\Support\Facades\Log;

class PelletEventBusLogger
{
    public function logConsumeUnit(UnitConsumed $unitConsumed): void
    {
        Log::info('log: ' . $unitConsumed->getJsonEncoded());
    }
}
