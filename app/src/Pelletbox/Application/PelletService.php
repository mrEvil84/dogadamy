<?php

namespace App\src\Pelletbox\Application;

use App\src\Pelletbox\Application\Command\Consume;
use App\src\Pelletbox\DomainModel\PelletBusPublisher;
use App\src\Pelletbox\DomainModel\StoreRepository;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidValueException;

class PelletService
{
    private PelletBusPublisher $pelletBus;
    private StoreRepository $storeRepository;

    public function __construct(
        PelletBusPublisher $pelletBus,
        StoreRepository $storeRepository
    ) {
        $this->pelletBus = $pelletBus;
        $this->storeRepository = $storeRepository;
    }

    /**
     * @throws InvalidValueException
     */
    public function consumeUnit(Consume $command): void
    {
        $this->pelletBus->publishConsumeUnit(
            new Unit($command->getUnitCount(), $command->getUnitWeight()),
            $command->getConsumeDate()
        );
    }

    public function storeUnit(Store $command): void
    {
        $this->storeRepository->store();

    }
}
