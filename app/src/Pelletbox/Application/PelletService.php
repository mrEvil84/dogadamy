<?php

namespace App\src\Pelletbox\Application;

use App\src\Pelletbox\Application\Command\Consume;
use App\src\Pelletbox\Application\Command\StoreUnit;
use App\src\Pelletbox\DomainModel\Consumer;
use App\src\Pelletbox\DomainModel\PelletBusPublisher;
use App\src\Pelletbox\DomainModel\StoreRepository;
use App\src\Pelletbox\DomainModel\ValueObjects\Producer;
use App\src\Pelletbox\DomainModel\ValueObjects\Unit;
use App\src\Pelletbox\Exceptions\InvalidValueException;
use PhpAmqpLib\Message\AMQPMessage;

class PelletService
{
    private PelletBusPublisher $pelletBus;
    private StoreRepository $storeRepository;
    private Consumer $consumer;

    public function __construct(
        PelletBusPublisher $pelletBus,
        StoreRepository $storeRepository,
        Consumer $consumer
    ) {
        $this->pelletBus = $pelletBus;
        $this->storeRepository = $storeRepository;
        $this->consumer = $consumer;
    }

    /**
     * @throws InvalidValueException
     */
    public function publishUnit(Consume $command): void
    {
        $this->pelletBus->publishConsumeUnit(
            new Unit(
                new Producer(1, 'test'), // todo
                $command->getUnitCount(),
                $command->getUnitWeight()
            ),
            $command->getConsumeDate()
        );
    }

    public function storeUnit(StoreUnit $command): void
    {
        $this->storeRepository->store($command->getUnit());
    }

    public function consume(AMQPMessage $message): void
    {
        $this->consumer->consume($message);
    }
}
