<?php

declare(strict_types=1);

namespace App\Providers;

use App\src\Pelletbox\Application\PelletService;
use App\src\Pelletbox\DomainModel\Consumer;
use App\src\Pelletbox\DomainModel\PelletBusPublisher;
use App\src\Pelletbox\DomainModel\PelletBusHandler;
use App\src\Pelletbox\DomainModel\StoreRepository;
use App\src\Pelletbox\Infrastructure\PelletAmqpConsumer;
use App\src\Pelletbox\Infrastructure\PelletAmqpPublisher;
use App\src\Pelletbox\Infrastructure\PelletDbRepositoryProxy;
use App\src\Pelletbox\Infrastructure\PelletEventBusPublisher;
use App\src\Pelletbox\Infrastructure\PelletEventBusHandler;
use App\src\Pelletbox\Infrastructure\PelletReadModelDbRepository;
use App\src\Pelletbox\Infrastructure\PelletReadModelRedisRepository;
use App\src\Pelletbox\Infrastructure\PelletReadModelStorageRepository;
use App\src\Pelletbox\Infrastructure\PelletRedisRepository;
use App\src\Pelletbox\ReadModel\PelletReadModel;
use App\src\Pelletbox\ReadModel\PelletReadModelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class PelletServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // singleton - object created only once in app , and hold the state
        // bind - object created ech time it is called , reusable classes and object
        $this->app->singleton(PelletAmqpPublisher::class, function ($app) {

            return PelletAmqpPublisher::getInstance();
        });

        $this->app->bind(PelletRedisRepository::class, function ($app) {
            return new PelletRedisRepository(Redis::connection());
        });

        $this->app->bind(PelletBusHandler::class, function ($app) {
            return new PelletEventBusHandler(
                resolve(PelletAmqpPublisher::class),
                resolve(PelletRedisRepository::class)
            );
        });

        $this->app->bind(PelletBusPublisher::class, function ($app) {
            return new PelletEventBusPublisher();
        });

        $this->app->bind(StoreRepository::class, function ($app) {
            return new PelletDbRepositoryProxy(
                DB::connection()
            );
        });

        $this->app->bind(Consumer::class, function ($app) {
            return PelletAmqpConsumer::getInstance(
                resolve(StoreRepository::class)
            );
        });

        $this->app->bind(PelletService::class, function ($app) {
            return new PelletService(
                resolve(PelletBusPublisher::class),
                resolve(StoreRepository::class),
                resolve(Consumer::class)
            );
        });

        $this->app->bind(PelletReadModelDbRepository::class, function ($app) {
            return new PelletReadModelDbRepository(DB::connection());
        });

        $this->app->bind(PelletReadModelRedisRepository::class, function ($app) {
            return new PelletReadModelRedisRepository(
                Redis::connection()
            );
        });

        $this->app->bind(PelletReadModelRepository::class, function ($app) {
            return new PelletReadModelStorageRepository(
                resolve(PelletReadModelDbRepository::class),
                resolve(PelletReadModelRedisRepository::class)
            );
        });

        $this->app->bind(PelletReadModel::class, function ($app) {
            return new PelletReadModel(
                resolve(PelletReadModelRepository::class)
            );
        });
    }

    public function boot(): void
    {
    }
}
