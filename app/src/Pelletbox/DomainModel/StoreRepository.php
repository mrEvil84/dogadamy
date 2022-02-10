<?php

namespace App\src\Pelletbox\DomainModel;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Utils\rabbitmq\AmqpConsumerProcessor;

interface StoreRepository
{
    public function store(Unit $unit): void;
}
