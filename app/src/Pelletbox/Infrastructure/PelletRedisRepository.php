<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use Illuminate\Redis\Connections\PhpRedisConnection;


class PelletRedisRepository
{
    private PhpRedisConnection $redisConnection;

    public function __construct(PhpRedisConnection $redisConnection)
    {
        $this->redisConnection = $redisConnection;
    }

    public function storeStatsCollection(StatsCollection $statsCollection): void
    {
        $keys = array_keys($statsCollection->getCollection());
        $statsCollectionData = $statsCollection->toArray();

        foreach ($keys as $key) {


//            var_dump(json_encode($statsCollectionData[$key], JSON_THROW_ON_ERROR));
//            die;
            $this->redisConnection->set(
                md5('pellet:stats:' . $key),
                json_encode($statsCollectionData[$key], JSON_THROW_ON_ERROR)
            );
        }
    }

}
