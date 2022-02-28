<?php

namespace App\Providers;

use App\Events\CreateCategoryProcessed;
use App\Listeners\CreateCategoryNotification;
use App\src\Pelletbox\DomainModel\Events\PelletStatsCached;
use App\src\Pelletbox\DomainModel\Events\UnitConsumed;
use App\src\Pelletbox\DomainModel\PelletBusHandler;
use App\src\Pelletbox\Infrastructure\PelletEventBusHandler;
use App\src\Pelletbox\Infrastructure\PelletEventBusLogger;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateCategoryProcessed::class => [
            CreateCategoryNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            UnitConsumed::class,
            [PelletBusHandler::class, 'handleConsumeUnit'],
        );

        Event::listen(
            UnitConsumed::class,
            [PelletEventBusLogger::class, 'logConsumeUnit']
        );

        Event::listen(
            PelletStatsCached::class,
            [PelletBusHandler::class, 'handleStatsCached'],
        );
    }
}
