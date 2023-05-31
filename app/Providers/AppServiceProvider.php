<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Products\Domain\Repositories\ProductRepository;
use Src\Products\Infrastructure\Repository\Eloquent\EloquentProductRespositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, EloquentProductRespositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
