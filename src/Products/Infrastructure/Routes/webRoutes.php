<?php

namespace Src\Products\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\Products\Application\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'matchEcommerceProducts'])
    ->name('ecommerce.products.productsList');

Route::get('/products/{slug}', [ProductController::class, 'detailEcommerceProducts'])
    ->name('ecommerce.products.productsDetail');

Route::get('/products-search', [ProductController::class, 'matchEcommerceProducts'])
    ->name('ecommerce.products.productsMatch');
