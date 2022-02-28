<?php

namespace App\src\Pelletbox\ReadModel;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use App\src\Pelletbox\ReadModel\Query\GetStatsByKey;

class PelletReadModel
{
    private PelletReadModelRepository $pelletReadModelRepository;

    public function __construct(PelletReadModelRepository $pelletReadModelRepository)
    {
        $this->pelletReadModelRepository = $pelletReadModelRepository;
    }

    public function getStats(GetStatsByKey $query): StatsCollection
    {
        return $this->pelletReadModelRepository->getStats($query);
    }
}
