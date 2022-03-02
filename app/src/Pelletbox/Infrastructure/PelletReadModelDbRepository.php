<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\ValueObjects\StatsCollection;
use App\src\Pelletbox\ReadModel\PelletReadModelRepository;
use App\src\Pelletbox\ReadModel\Query\GetStatsQuery;
use App\src\Pelletbox\SharedKernel\Key;
use Illuminate\Database\ConnectionInterface;

class PelletReadModelDbRepository implements PelletReadModelRepository
{
    private ConnectionInterface $dbHandler;

    public function __construct(ConnectionInterface $dbHandler)
    {
        $this->dbHandler = $dbHandler;
    }

    public function getStats(GetStatsQuery $query): StatsCollection
    {
        $sql = '
            SELECT
                pu.bag_amount AS bagAmount,
                pu.created_at AS createdAt
            FROM
                pellet_usage AS pu
            WHERE
                pu.created_at >= DATE(:date);
        ';
        $result = $this->dbHandler->select(
            $sql,
            ['date' => $query->getKey()->getKeyValue()]
        );

        return StatsCollection::fromRawData($result);
    }

    public function isStatsExists(Key $key): bool
    {
       return false;
    }
}
