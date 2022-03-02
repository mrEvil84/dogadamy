<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use App\src\Pelletbox\ReadModel\PelletReadModelRepository;
use App\src\Pelletbox\ReadModel\Query\GetStatsQuery;
use App\src\Pelletbox\SharedKernel\Key;
use Illuminate\Redis\Connections\PhpRedisConnection;

class PelletReadModelRedisRepository implements PelletReadModelRepository
{
    private PhpRedisConnection $redisConnection;
    private PelletRedisKeyFactory $pelletRedisKeyFactory;

    public function __construct(PhpRedisConnection $redisConnection, PelletRedisKeyFactory $pelletRedisKeyFactory)
    {
        $this->redisConnection = $redisConnection;
        $this->pelletRedisKeyFactory = $pelletRedisKeyFactory;
    }

    /**
     * @throws \JsonException
     */
    public function getStats(GetStatsQuery $query): StatsCollection
    {
        $keyValue = $query->getKey()->getKeyValue();

        $data = json_decode(
            $this->redisConnection->get(md5(self::PELLET_STATS_REDIS_PREFIX . $keyValue)),
            false,
            512,
            JSON_THROW_ON_ERROR
        );

        return StatsCollection::fromRawData($data);
    }

    public function isStatsExists(Key $key): bool
    {
        $redisStataKey = $this->pelletRedisKeyFactory->getRedisStatsKey($key);
        return $this->redisConnection->exists($redisStataKey) === 1;
    }
}
