<?php

namespace App\src\Pelletbox\ReadModel\Query;

use App\src\Pelletbox\SharedKernel\DateKey;

class GetStatsByDate extends GetStatsQuery
{
    private \DateTime $dateTime;

    public function __construct(\DateTime $dateTime)
    {
        parent::__construct(new DateKey($dateTime));
        $this->dateTime = $dateTime;
    }

    public function getDateTime(): \DateTime
    {
        return $this->dateTime;
    }
}
