<?php

namespace App\Everstore\ShoppingCart\Application\Actions;

use App\Everstore\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

class GetItemsShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    public function __invoke(): ItemsShoppingCartData
    {
        $shoppingCart = $this->shoppingCartRepository->getItems();
        $shoppingCartData = new ItemsShoppingCartData($shoppingCart);

        return $shoppingCartData;
    }
}
