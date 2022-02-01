<?php

namespace App\src\Pelletbox\Application;

use App\src\Pelletbox\Application\Command\Consume;
use App\src\Pelletbox\DomainModel\PelletBus;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidValueException;

class PelletService
{
    private PelletBus $pelletBus;

    public function __construct(PelletBus $pelletBus)
    {
        $this->pelletBus = $pelletBus;
    }

    /**
     * @throws InvalidValueException
     */
    public function consumeUnit(Consume $command): void
    {
        $this->pelletBus->consumeUnit(
            new Unit($command->getUnitCount(), $command->getUnitWeight()),
            $command->getConsumeDate()
        );
    }
}
