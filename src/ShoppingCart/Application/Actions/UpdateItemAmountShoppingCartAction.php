<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use Src\ShoppingCart\Domain\Enums\UpdateOptionsEnum;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

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
