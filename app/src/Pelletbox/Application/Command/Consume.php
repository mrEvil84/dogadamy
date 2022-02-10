<?php

declare(strict_types = 1);

namespace App\src\Pelletbox\Application\Command;

class Consume
{
    public const DEFAULT_UNIT_WEIGHT = 15;
    public const DEFAULT_UNIT_COUNT = 1;

    private int $unitCount;
    private int $unitWeight;
    private \DateTime $consumeDate;

    public function __construct(
        int $unitCount = self::DEFAULT_UNIT_COUNT,
        int $unitWeight = self::DEFAULT_UNIT_WEIGHT
    ) {
        $this->unitCount = $unitCount;
        $this->unitWeight = $unitWeight;
        $this->consumeDate = new \DateTime('now');
    }

    public function getUnitCount(): int
    {
        return $this->unitCount;
    }

    public function getUnitWeight(): int
    {
        return $this->unitWeight;
    }

    public function getConsumeDate(): \DateTime
    {
        return $this->consumeDate;
    }
}
