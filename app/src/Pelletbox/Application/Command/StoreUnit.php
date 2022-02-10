<?php

declare(strict_types=1);

namespace App\src\Pelletbox\Application\Command;

use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidDataStructure;
use App\src\Pelletbox\Exceptions\InvalidValueException;

class StoreUnit
{
    private Unit $unit;

    /**
     * @throws InvalidValueException
     * @throws InvalidDataStructure
     */
    public function __construct(array $rawData) {
        $this->unit = Unit::fromRawData($rawData);
    }

    public function getUnit(): Unit
    {
        return $this->unit;
    }
}
