<?php

namespace Src\ShoppingCart\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Src\Products\Domain\ValuesObjects\ProductId;
use Src\Products\Infrastructure\Persistence\Eloquent\EloquentProductEntity;
use Src\ShoppingCart\Application\Actions\AddItemShoppingCartAction;
use Src\ShoppingCart\Application\Actions\GetItemsShoppingCartAction;
use Src\ShoppingCart\Application\Actions\RemoveItemShoppingCartAction;
use Src\ShoppingCart\Application\Actions\SetItemAmountShoppingCartAction;
use Src\ShoppingCart\Application\Actions\UpdateItemAmountShoppingCartAction;
use Src\ShoppingCart\Domain\Enums\UpdateOptionsEnum;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;

class ShoppingCartController
{
    public function __construct(
        private readonly GetItemsShoppingCartAction $getItemsShoppingCartAction,
        private readonly AddItemShoppingCartAction $addItemShoppingCartAction,
        private readonly UpdateItemAmountShoppingCartAction $updateItemAmountShoppingCartAction,
        private readonly RemoveItemShoppingCartAction $removeItemShoppingCartAction,
        private readonly SetItemAmountShoppingCartAction $setItemAmountShoppingCartAction,
    ) {
    }

    public function index(): View
    {
        ($this->getItemsShoppingCartAction)();

        return view('pages.ecommerce.shopping.shoppingCart');
    }

    public function indexApi(): JsonResponse
    {
        $shoppingCartData = ($this->getItemsShoppingCartAction)();

        return response()->json($shoppingCartData);
    }

    public function addItem(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'productId' => 'required|numeric',
            'amount' => 'numeric',
        ]);

        $productId = new ProductId($validated['productId']);
        $amount = $validated['amount'] ?? 1;

        $product = EloquentProductEntity::where('id', $productId->value())->first();

        $itemShoppingCart = new ItemShoppingCart(
            $productId,
            $product->name,
            $product->description,
            $product->slug,
            $product->image_url,
            $product->price,
            $product->price * $amount,
            $amount
        );

        $shoppingCartData = ($this->addItemShoppingCartAction)($itemShoppingCart);

        return response()->json($shoppingCartData);
    }

    public function removeItem(string $productId): JsonResponse
    {
        $productId = new ProductId($productId);

        $shoppingCartData = ($this->removeItemShoppingCartAction)($productId);

        return response()->json($shoppingCartData);
    }

    public function updateItemAmount(string $productId, Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'numeric',
            'option' => [new Enum(UpdateOptionsEnum::class)],
        ]);

        $productId = new ProductId($productId);
        $amount = $validated['amount'] ?? 1;
        $option = UpdateOptionsEnum::from($validated['option']);

        $product = EloquentProductEntity::where('id', $productId->value())->first();

        $itemShoppingCart = new ItemShoppingCart(
            $productId,
            $product->name,
            $product->description,
            $product->slug,
            $product->image_url,
            $product->price,
            $product->price * $amount,
            $amount
        );

        $shoppingCartData = ($this->updateItemAmountShoppingCartAction)($itemShoppingCart, $option);

        return response()->json($shoppingCartData);
    }

    public function setItemAmount(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'productId' => 'required|numeric',
            'amount' => 'numeric',
        ]);

        $productId = new ProductId($validated['productId']);
        $amount = $validated['amount'] ?? 1;

        $product = EloquentProductEntity::where('id', $productId->value())->first();

        $itemShoppingCart = new ItemShoppingCart(
            $productId,
            $product->name,
            $product->description,
            $product->slug,
            $product->image_url,
            $product->price,
            $product->price * $amount,
            $amount
        );

        ($this->setItemAmountShoppingCartAction)($itemShoppingCart);

        return back();
    }
}
