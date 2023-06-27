<?php

namespace App\Everstore\ShoppingCart\Domain\Repositories;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use App\Everstore\ShoppingCart\Domain\Models\ShoppingCart;

interface ShoppingCartRepositoryInterface
{
    public function getItems(): ShoppingCart;

    public function addItem(ItemShoppingCart $itemShoppingCart): ShoppingCart;

    public function removeItem(ProductId $productId): ShoppingCart;

    public function setItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCart;

    public function incrementItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCart;

    public function decrementItemAmount(ProductId $productId, int $amount): ShoppingCart;
}
