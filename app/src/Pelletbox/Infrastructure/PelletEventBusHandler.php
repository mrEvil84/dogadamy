<?php

declare(strict_types = 1);

namespace App\src\Pelletbox\Infrastructure;

use App\src\Pelletbox\DomainModel\Events\PelletStatsCached;
use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\PelletBusHandler;
use App\src\Utils\rabbitmq\AmqpPublisher;
use Illuminate\Support\Facades\Log;
use JsonException;

class PelletEventBusHandler implements PelletBusHandler
{
    private AmqpPublisher $amqpPublisher;
    private PelletRedisRepository $redisRepository;

    public function __construct(
        AmqpPublisher $amqpPublisher,
        PelletRedisRepository $redisRepository
    ) {
        $this->amqpPublisher = $amqpPublisher;
        $this->redisRepository = $redisRepository;
    }

    /**
     * @throws JsonException
     */
    public function handleConsumeUnit(UnitConsumed $unitConsumed): void
    {
        $this->amqpPublisher->publish($unitConsumed->getJsonEncoded());
    }

    /**
     * @throws JsonException
     */
    public function handleStatsCached(PelletStatsCached $statsCached): void
    {
        $statsCollection = $statsCached->getStatsCollection();
        $this->redisRepository->storeStatsCollection($statsCollection);
        Log::channel('added-to-redis-cache')->info(
            json_encode($statsCached->getStatsCollection()->toArray(), JSON_THROW_ON_ERROR)
        );
    }
}
