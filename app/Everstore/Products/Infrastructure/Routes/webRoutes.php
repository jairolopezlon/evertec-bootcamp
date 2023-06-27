<?php

namespace App\Everstore\Products\Infrastructure\Routes;

use App\Everstore\Products\Application\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'matchEcommerceProducts'])
    ->name('ecommerce.products.productsList');

Route::get('/products/{slug}', [ProductController::class, 'detailEcommerceProducts'])
    ->name('ecommerce.products.productsDetail');

Route::get('/products-search', [ProductController::class, 'matchEcommerceProducts'])
    ->name('ecommerce.products.productsMatch');
