<?php

namespace Src\ShoppingCart\Domain\Repositories;

use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Models\ShoppingCart;

interface ShoppingCartRepositoryInterface
{
    public function getItems(): ShoppingCart;

    public function addItem(ItemShoppingCart $itemShoppingCart): ShoppingCart;

    public function removeItem(ProductId $productId): ShoppingCart;

    public function setItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCart;

    public function incrementItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCart;

    public function decrementItemAmount(ProductId $productId, int $amount): ShoppingCart;
}