<?php

namespace Src\Products\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\Products\Application\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'listEcommerceProducts'])
    ->name('ecommerce.products.productsList');

Route::get('/products/{slug}', [ProductController::class, 'detailEcommerceProducts'])
    ->name('ecommerce.products.productsDetail');
