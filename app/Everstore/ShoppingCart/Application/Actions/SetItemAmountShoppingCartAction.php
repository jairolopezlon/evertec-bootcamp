<?php

namespace App\Everstore\ShoppingCart\Application\Actions;

use App\Everstore\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

class SetItemAmountShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    public function __invoke(ItemShoppingCart $itemShoppingCart): ItemsShoppingCartData
    {
        $shoppingCart = $this->shoppingCartRepository->setItemAmount($itemShoppingCart);

        $shoppingCartData = new ItemsShoppingCartData($shoppingCart);

        return $shoppingCartData;
    }
}
