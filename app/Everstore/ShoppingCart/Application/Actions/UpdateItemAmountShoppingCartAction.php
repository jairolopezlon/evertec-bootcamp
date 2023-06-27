<?php

namespace App\Everstore\ShoppingCart\Application\Actions;

use App\Everstore\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use App\Everstore\ShoppingCart\Domain\Enums\UpdateOptionsEnum;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

class UpdateItemAmountShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    public function __invoke(ItemShoppingCart $itemShoppingCart, UpdateOptionsEnum $option): ItemsShoppingCartData
    {
        if ($option === UpdateOptionsEnum::INCREMENT) {
            $shoppingCart = $this->shoppingCartRepository->incrementItemAmount($itemShoppingCart);
        }

        if ($option === UpdateOptionsEnum::DECREMENT) {
            $shoppingCart = $this->shoppingCartRepository
                ->decrementItemAmount(
                    $itemShoppingCart->getProductId(),
                    $itemShoppingCart->getAmount(),
                );
        }

        $shoppingCartData = new ItemsShoppingCartData($shoppingCart);

        return $shoppingCartData;
    }
}
