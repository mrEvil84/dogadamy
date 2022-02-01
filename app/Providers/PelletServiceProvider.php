<?php

declare(strict_types=1);

namespace App\Providers;

use App\src\Pelletbox\Application\PelletService;
use App\src\Pelletbox\DomainModel\PelletBus;
use App\src\Pelletbox\DomainModel\PelletBusHandler;
use App\src\Pelletbox\Infrastructure\PelletAmqpPublisher;
use App\src\Pelletbox\Infrastructure\PelletEventBus;
use App\src\Pelletbox\Infrastructure\PelletEventBusHandler;
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
            return new PelletEventBusHandler(resolve(PelletAmqpPublisher::class));
        });

        $this->app->bind(PelletBus::class, function ($app) {
            return new PelletEventBus();
        });

        $this->app->bind(PelletService::class, function ($app) {
            return new PelletService(resolve(PelletBus::class));
        });
    }

    public function boot(): void
    {
    }
}
