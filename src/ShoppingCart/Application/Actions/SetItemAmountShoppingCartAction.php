<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

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
