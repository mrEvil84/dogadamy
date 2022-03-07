<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use Illuminate\Redis\Connections\PhpRedisConnection;


class PelletRedisRepository
{
    private PhpRedisConnection $redisConnection;
    private PelletRedisKeyFactory $pelletRedisKeyFactory;

    public function __construct(PhpRedisConnection $redisConnection, PelletRedisKeyFactory $pelletRedisKeyFactory)
    {
        $this->redisConnection = $redisConnection;
        $this->pelletRedisKeyFactory = $pelletRedisKeyFactory;
    }

    public function storeStatsCollection(StatsCollection $statsCollection): void
    {
        $dateKeys = array_keys($statsCollection->getCollection());
        $statsCollectionData = $statsCollection->toArray();

        foreach ($dateKeys as $key) {

            $this->redisConnection->set(
                $this->pelletRedisKeyFactory->getRedisStatsKeyFromDate($key),
                json_encode($statsCollectionData[$key], JSON_THROW_ON_ERROR)
            );
        }
    }
}
