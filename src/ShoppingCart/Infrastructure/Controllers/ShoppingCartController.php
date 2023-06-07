<?php

namespace Src\ShoppingCart\Infrastructure\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Application\Actions\AddItemShoppingCartAction;
use Src\ShoppingCart\Application\Actions\GetAllItemsShoppingCartAction;
use Src\ShoppingCart\Application\Actions\RemoveItemShoppingCartAction;
use Src\ShoppingCart\Application\Actions\UpdateItemAmountShoppingCartAction;
use Src\ShoppingCart\Domain\Enums\UpdateOptionsEnum;

/**
 * @phpstan-type PrimitiveItemShoppingCartData array{productId: string, amount: int}
 */
class ShoppingCartController
{
    public function __construct(
        private readonly GetAllItemsShoppingCartAction $getAllItemsShoppingCartAction,
        private readonly AddItemShoppingCartAction $addItemShoppingCartAction,
        private readonly UpdateItemAmountShoppingCartAction $updateItemAmountShoppingCartAction,
        private readonly RemoveItemShoppingCartAction $removeItemShoppingCartAction,
    ) {
    }

    /**
     * @return array<PrimitiveItemShoppingCartData>
     */
    public function getAll()
    {
        return ($this->getAllItemsShoppingCartAction)();
    }

    public function addItem(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'productId' => 'required|numeric',
            'amount' => 'numeric',
        ]);

        $productId = new ProductId($validated['productId']);
        $amount = $validated['amount'] ?? null;

        $shoppingCartData = ($this->addItemShoppingCartAction)($productId, $amount);

        return back()->with('shoppingCartData', $shoppingCartData);
    }

    public function removeItem(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'productId' => 'required|numeric',
        ]);

        $productId = new ProductId($validated['productId']);

        $shoppingCartData = ($this->removeItemShoppingCartAction)($productId);

        return back()->with('shoppingCartData', $shoppingCartData);
    }

    public function updateItemAmount(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'productId' => 'required|numeric',
            'amount' => 'numeric',
            'option' => [new Enum(UpdateOptionsEnum::class)],
        ]);

        $productId = new ProductId($validated['productId']);
        $amount = $validated['amount'] ?? null;
        $option = UpdateOptionsEnum::from($validated['option']);

        $shoppingCartData = ($this->updateItemAmountShoppingCartAction)($productId, $amount, $option);

        return back()->with('shoppingCartData', $shoppingCartData);
    }
}
