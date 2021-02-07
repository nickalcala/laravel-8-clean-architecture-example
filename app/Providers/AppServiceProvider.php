<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Application/Core
        $this->app->bind(
            \Core\Product\Commands\ICreateProduct::class,
            \Core\Product\Commands\CreateProduct::class
        );
        $this->app->bind(
            \Core\Product\Queries\IGetProductPagination::class,
            \Core\Product\Queries\GetProductPagination::class
        );

        // Persistence
        $this->app->bind(
            \Core\Product\Repositories\IProductRepository::class,
            \Infrastructure\Product\ProductRepository::class
        );

        // Infrastructure
        $this->app->bind(
            \Core\Interfaces\IImageOptimizeService::class,
            \Infrastructure\ImageOptimize\ImageOptimizeService::class
        );

        // Common
        $this->app->bind(
            \Common\Date\IDateService::class,
            \Common\Date\DateService::class
        );
    }

    public function boot()
    {
    }
}
