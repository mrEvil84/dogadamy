<?php

namespace App\src\Pelletbox\ReadModel;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use App\src\Pelletbox\ReadModel\Query\GetStatsByKey;
use App\src\Pelletbox\SharedKernel\Key;

interface PelletReadModelRepository
{
    public function getStats(GetStatsByKey $query): StatsCollection;
    public function isStatsExists(Key $key): bool;
}
