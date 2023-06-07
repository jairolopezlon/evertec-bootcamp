<?php

namespace Src\ShoppingCart\Domain\Models;

use Src\Products\Domain\ValuesObjects\ProductId;

class ShoppingCart
{
    /**
     * @param  array<ItemShoppingCart>  $itemsCart
     */
    public function __construct(
        private array $itemsCart,
    ) {
        $this->itemsCart = $itemsCart;
    }

    /**
     * Summary of getItemsCart
     *
     * @return array<ItemShoppingCart>
     */
    public function getItemsCart()
    {
        return $this->itemsCart;
    }

    public function addItemCart(ItemShoppingCart $itemShoppingCart): void
    {
        $this->itemsCart[$itemShoppingCart->getProductId()->value()] = $itemShoppingCart;
    }

    public function removeItemCart(ProductId $productId): void
    {
        unset($this->itemsCart[$productId->value()]);
    }

    public function hasItem(ProductId $productId): bool
    {
        return isset($this->itemsCart[$productId->value()]);
    }

    public function getItem(ProductId $productId): ItemShoppingCart
    {
        return $this->itemsCart[$productId->value()];
    }
}
