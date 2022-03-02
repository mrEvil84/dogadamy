<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\SharedKernel\Key;

class PelletRedisKeyFactory
{
    private const PELLET_STATS_REDIS_PREFIX = 'pellet:stats:';

    public function getRedisStatsKey(Key $key): string
    {
        return md5(self::PELLET_STATS_REDIS_PREFIX . $key->getKeyValue());
    }

    public function getRedisStatsKeyFromDate(string $date): string
    {
        return md5(self::PELLET_STATS_REDIS_PREFIX . $date);
    }
}
