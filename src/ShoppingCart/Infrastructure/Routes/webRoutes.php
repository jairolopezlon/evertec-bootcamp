<?php

namespace Src\ShoppingCart\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\ShoppingCart\Infrastructure\Controllers\ShoppingCartController;

Route::get('/shopping-cart', [ShoppingCartController::class, 'getAll'])
    ->name('ecommerce.shoppingCart.getAllItems');

Route::post('/shopping-cart', [ShoppingCartController::class, 'addItem'])
    ->name('ecommerce.shoppingCart.addItem');

Route::patch('/shopping-cart', [ShoppingCartController::class, 'updateItemAmount'])
    ->name('ecommerce.shoppingCart.updateItemAmount');

Route::delete('/shopping-cart', [ShoppingCartController::class, 'removeItem'])
    ->name('ecommerce.shoppingCart.removeItemAmount');
