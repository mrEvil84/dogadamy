<?php

namespace App\src\Pelletbox\DomainModel\ValueObjects;

use App\src\Pelletbox\Exceptions\InvalidValueException;

final class Unit
{
    public const DEFAULT_UNIT_WEIGHT = 15;
    public const DEFAULT_UNIT_COUNT = 1;

    private int $unitCount;
    private int $unitWeight;

    public function __construct(int $unitCount = self::DEFAULT_UNIT_COUNT, int $unitWeight = self::DEFAULT_UNIT_WEIGHT)
    {
        if ($unitCount <= 0) {
            throw new InvalidValueException('Invalid unit count.');
        }

        if ($unitWeight <= 0) {
            throw new InvalidValueException('Invalid unit weight.');
        }

        $this->unitCount = $unitCount;
        $this->unitWeight = $unitWeight;
    }

    public function getUnitCount(): int
    {
        return $this->unitCount;
    }

    public function getUnitWeight(): int
    {
        return $this->unitWeight;
    }

    public function toArray(): array
    {
        return [
            'unitCount' => $this->unitCount,
            'unitWeight' => $this->unitWeight
        ];
    }
}
