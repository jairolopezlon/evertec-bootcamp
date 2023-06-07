<?php

namespace Src\ShoppingCart\Domain\Repositories;

use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Domain\Dtos\ItemShoppingCartData;
use Src\ShoppingCart\Domain\Dtos\ShoppingCartData;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;

interface ShoppingCartRepositoryInterface
{
    public function getAll(): ShoppingCartData;

    public function getItem(ProductId $productId): ItemShoppingCartData;

    public function addItem(ItemShoppingCart $itemShoppingCart): ShoppingCartData;

    public function removeItem(ProductId $productId): ShoppingCartData;

    public function incrementItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCartData;

    public function decreaseItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCartData;

    public function getAllItemsWithProductData(): void;
}
