<?php

namespace Src\ShoppingCart\Application\Actions;

use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Domain\Enums\UpdateOptionsEnum;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class UpdateItemAmountShoppingCartAction
{
    public function __construct(
        private readonly ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    /**
     * @return array<PrimitiveItemShoppingCartData>
     */
    public function __invoke(ProductId $productId, ?int $amount, UpdateOptionsEnum $option): array
    {
        $itemShoppingCart = new ItemShoppingCart($productId, $amount);

        if ($option === UpdateOptionsEnum::DECREASE) {
            $shoppingCartData = $this->shoppingCartRepository->decreaseItemAmount($itemShoppingCart);
        }
        if ($option === UpdateOptionsEnum::INCREMENT) {
            $shoppingCartData = $this->shoppingCartRepository->incrementItemAmount($itemShoppingCart);
        }

        return $shoppingCartData->toArray();
    }
}
