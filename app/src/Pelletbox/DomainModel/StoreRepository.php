<?php

namespace App\src\Pelletbox\DomainModel;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;

interface StoreRepository
{
    public function store(Unit $unit): void;
}
