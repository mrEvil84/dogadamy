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
use Illuminate\Support\Facades\DB;
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

        $this->app->bind(PelletBusHandler::class, function ($app) {
            return new PelletEventBusHandler(
                resolve(PelletAmqpPublisher::class)
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
    }

    public function boot(): void
    {
    }
}
