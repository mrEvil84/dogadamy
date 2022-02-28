<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\PelletStatsCached;
use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use App\src\Pelletbox\ReadModel\PelletReadModelRepository;
use App\src\Pelletbox\ReadModel\Query\GetStatsByKey;
use App\src\Pelletbox\SharedKernel\Key;

class PelletReadModelStorageRepository implements PelletReadModelRepository
{
    private PelletReadModelDbRepository $dbRepository;
    private PelletReadModelRedisRepository $redisRepository;

    public function __construct(
        PelletReadModelDbRepository $dbRepository,
        PelletReadModelRedisRepository $redisRepository
    ) {
        $this->dbRepository = $dbRepository;
        $this->redisRepository = $redisRepository;
    }

    /**
     * @throws \JsonException
     */
    public function getStats(GetStatsByKey $query): StatsCollection
    {
        if ($this->redisRepository->isStatsExists($query->getKey())) {
            return $this->redisRepository->getStats($query);
        }

        $statsCollection = $this->dbRepository->getStats($query);

        event(new PelletStatsCached($statsCollection));

        return $statsCollection;
    }

    public function isStatsExists(Key $key): bool
    {
       return $this->redisRepository->isStatsExists($key) && $this->dbRepository->isStatsExists($key);
    }
}
