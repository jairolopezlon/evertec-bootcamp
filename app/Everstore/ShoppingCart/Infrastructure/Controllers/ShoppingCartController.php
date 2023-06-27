<?php

namespace App\Everstore\ShoppingCart\Infrastructure\Controllers;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;
use App\Everstore\Products\Infrastructure\Persistence\Eloquent\EloquentProductEntity;
use App\Everstore\ShoppingCart\Application\Actions\AddItemShoppingCartAction;
use App\Everstore\ShoppingCart\Application\Actions\GetItemsShoppingCartAction;
use App\Everstore\ShoppingCart\Application\Actions\RemoveItemShoppingCartAction;
use App\Everstore\ShoppingCart\Application\Actions\SetItemAmountShoppingCartAction;
use App\Everstore\ShoppingCart\Application\Actions\UpdateItemAmountShoppingCartAction;
use App\Everstore\ShoppingCart\Domain\Enums\UpdateOptionsEnum;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

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
