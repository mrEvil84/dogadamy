<?php

declare(strict_types=1);

namespace App\Providers;

use App\src\Categories\Application\CategoriesService;
use App\src\Categories\DomainModel\CategoriesRepository;
use App\src\Categories\Infrastructure\CategoriesDbRepository;
use App\src\Categories\Infrastructure\CategoriesReadModelDbRepository;
use App\src\Categories\ReadModel\CategoriesReadModel;
use App\src\Categories\ReadModel\CategoriesReadModelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CategoriesReadModel::class, function ($app) {
            return new CategoriesReadModel(
                resolve(CategoriesReadModelRepository::class)
            );
        });

        $this->app->singleton(CategoriesService::class, function ($app) {
            return new CategoriesService(
                resolve(
                    CategoriesRepository::class
                )
            );
        });

        $this->app->singleton(CategoriesReadModelRepository::class, function ($app) {
            return new CategoriesReadModelDbRepository(
                DB::connection()
            );
        });

        $this->app->singleton(CategoriesRepository::class, function ($app) {
            return new CategoriesDbRepository(
                DB::connection()
            );
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
