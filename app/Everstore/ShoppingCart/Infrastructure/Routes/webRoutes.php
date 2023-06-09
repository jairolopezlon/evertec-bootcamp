<?php

namespace App\Everstore\ShoppingCart\Infrastructure\Routes;

use App\Everstore\ShoppingCart\Infrastructure\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;

Route::get('/shopping-cart', [ShoppingCartController::class, 'index'])
    ->name('ecommerce.shoppingCart.index');

Route::get('/api/shopping-cart', [ShoppingCartController::class, 'indexApi'])
    ->name('ecommerce.shoppingCart.indexApi');

Route::post('/api/shopping-cart', [ShoppingCartController::class, 'addItem'])
    ->name('ecommerce.shoppingCart.addItem');

Route::put('/api/shopping-cart/{productId}', [ShoppingCartController::class, 'setItemAmount'])
    ->name('ecommerce.shoppingCart.setItemAmount');

Route::patch('/api/shopping-cart/{productId}', [ShoppingCartController::class, 'updateItemAmount'])
    ->name('ecommerce.shoppingCart.updateItemAmount');

Route::delete('/api/shopping-cart/{productId}', [ShoppingCartController::class, 'removeItem'])
    ->name('ecommerce.shoppingCart.removeItemAmount');
