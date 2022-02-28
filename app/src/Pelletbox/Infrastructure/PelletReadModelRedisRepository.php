<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use App\src\Pelletbox\ReadModel\PelletReadModelRepository;
use App\src\Pelletbox\ReadModel\Query\GetStatsByKey;
use App\src\Pelletbox\SharedKernel\Key;
use Illuminate\Redis\Connections\PhpRedisConnection;

class PelletReadModelRedisRepository implements PelletReadModelRepository
{
    private PhpRedisConnection $redisConnection;

    public function __construct(PhpRedisConnection $redisConnection)
    {
        $this->redisConnection = $redisConnection;
    }

    public function getStats(GetStatsByKey $query): StatsCollection
    {
        $keyValue = $query->getKey()->getKeyValue();

        $data = json_decode(
            $this->redisConnection->get(md5('pellet:stats:' . $keyValue)),
            false,
            512,
            JSON_THROW_ON_ERROR
        );

        return StatsCollection::fromRawData($data);
    }

    public function isStatsExists(Key $key): bool
    {
        $data = $this->redisConnection->get(md5('pellet:stats:' . $key->getKeyValue()));
        return $data !== false;
    }
}
