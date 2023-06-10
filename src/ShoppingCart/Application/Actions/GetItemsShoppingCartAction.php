<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

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
