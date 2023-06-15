<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Checkout\Domain\Services\CheckoutServiceInterface;
use Src\Checkout\Infrastructure\Services\CheckoutServiceImpl;
use Src\Orders\Domain\Repositories\OrderRepositoryInterface;
use Src\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderRepositoryImpl;
use Src\Products\Domain\Repositories\ProductRepository;
use Src\Products\Infrastructure\Persistence\Eloquent\EloquentProductRespositoryImpl;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;
use Src\ShoppingCart\Infrastructure\Persistence\SessionStorage\SessionStorageShoppingCartRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepository::class, EloquentProductRespositoryImpl::class);
        $this->app->bind(ShoppingCartRepositoryInterface::class, SessionStorageShoppingCartRepositoryImpl::class);
        $this->app->bind(CheckoutServiceInterface::class, CheckoutServiceImpl::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
