<?php

namespace App\Providers;

use App\Everstore\Checkout\Domain\Services\CheckoutServiceInterface;
use App\Everstore\Checkout\Infrastructure\Services\CheckoutServiceImpl;
use App\Everstore\Orders\Domain\Repositories\OrderRepositoryInterface;
use App\Everstore\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderRepositoryImpl;
use App\Everstore\Products\Domain\Repositories\ProductRepository;
use App\Everstore\Products\Infrastructure\Persistence\Eloquent\EloquentProductRespositoryImpl;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;
use App\Everstore\ShoppingCart\Infrastructure\Persistence\SessionStorage\SessionStorageShoppingCartRepositoryImpl;
use Illuminate\Support\ServiceProvider;

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
