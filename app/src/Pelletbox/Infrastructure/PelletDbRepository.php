<?php

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\StoreRepository;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use Illuminate\Support\Facades\DB;

class PelletDbRepository implements StoreRepository
{
    private DB $dbHandler;

    public function __construct(DB $dbHandler)
    {
        $this->dbHandler = $dbHandler;
    }

    public function store(Unit $unit): void
    {
        $sql = 'INSERT INTO pellet_usage (bag_amount, producer_id) VALUES (:bagAmount, :producerId)';
        $this->dbHandler->insert();
    }


}
