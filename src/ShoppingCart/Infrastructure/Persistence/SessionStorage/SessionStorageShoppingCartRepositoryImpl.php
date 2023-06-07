<?php

namespace Src\ShoppingCart\Infrastructure\Persistence\SessionStorage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Src\Products\Domain\ValuesObjects\ProductId;
use Src\ShoppingCart\Domain\Dtos\ItemShoppingCartData;
use Src\ShoppingCart\Domain\Dtos\ShoppingCartData;
use Src\ShoppingCart\Domain\Models\ItemShoppingCart;
use Src\ShoppingCart\Domain\Models\ShoppingCart;
use Src\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;

class SessionStorageShoppingCartRepositoryImpl implements ShoppingCartRepositoryInterface
{
    public function getAll(): ShoppingCartData
    {
        $request = App::make(Request::class);

        /** @var ShoppingCart|null */
        $shoppingCartSession = $request->session()->get('shoppingCart');

        if (is_null($shoppingCartSession)) {
            $shoppingCartSession = new ShoppingCart([]);
        }

        $request->session()->put('shoppingCart', $shoppingCartSession);

        $shoppingCartData = new ShoppingCartData($shoppingCartSession);

        return $shoppingCartData;
    }

    public function getItem(ProductId $productId): ItemShoppingCartData
    {
        $request = App::make(Request::class);

        /** @var ShoppingCart */
        $shoppingCartSession = $request->session()->get('shoppingCart', new ShoppingCart([]));

        $itemShoppingCart = $shoppingCartSession->getItem($productId);

        return new ItemShoppingCartData($itemShoppingCart);
    }

    public function addItem(ItemShoppingCart $itemShoppingCart): ShoppingCartData
    {
        $request = App::make(Request::class);

        /** @var ShoppingCart */
        $shoppingCartSession = $request->session()->get('shoppingCart', new ShoppingCart([]));

        $productId = $itemShoppingCart->getProductId();

        if ($shoppingCartSession->hasItem($productId)) {
            $shoppingCartSession->getItem($productId)->incrementAmount($itemShoppingCart->getAmount());
        } else {
            $shoppingCartSession->addItemCart($itemShoppingCart);
        }

        $request->session()->put('shoppingCart', $shoppingCartSession);

        return new ShoppingCartData($shoppingCartSession);
    }

    public function removeItem(ProductId $productId): ShoppingCartData
    {
        $request = App::make(Request::class);

        /** @var ShoppingCart */
        $shoppingCartSession = $request->session()->get('shoppingCart', new ShoppingCart([]));

        if ($shoppingCartSession->hasItem($productId)) {
            $shoppingCartSession->removeItemCart($productId);
        }

        $request->session()->put('shoppingCart', $shoppingCartSession);

        return new ShoppingCartData($shoppingCartSession);
    }

    public function incrementItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCartData
    {
        $request = App::make(Request::class);
        /** @var ShoppingCart */
        $shoppingCartSession = $request->session()->get('shoppingCart', new ShoppingCart([]));

        $productId = $itemShoppingCart->getProductId();

        if ($shoppingCartSession->hasItem($productId)) {
            $shoppingCartSession->getItem($productId)->incrementAmount($itemShoppingCart->getAmount());
        } else {
            $shoppingCartSession->addItemCart($itemShoppingCart);
        }

        $request->session()->put('shoppingCart', $shoppingCartSession);

        return new ShoppingCartData($shoppingCartSession);
    }

    public function decreaseItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCartData
    {
        $request = App::make(Request::class);
        /** @var ShoppingCart */
        $shoppingCartSession = $request->session()->get('shoppingCart', new ShoppingCart([]));

        $productId = $itemShoppingCart->getProductId();

        if ($shoppingCartSession->hasItem($productId)) {
            $shoppingCartSession->getItem($productId)->decreaseAmount($itemShoppingCart->getAmount());
        }

        if ($shoppingCartSession->getItem($productId)->getAmount() <= 0) {
            $shoppingCartSession->removeItemCart($productId);
        }

        $request->session()->put('shoppingCart', $shoppingCartSession);

        return new ShoppingCartData($shoppingCartSession);
    }

    public function getAllItemsWithProductData(): void
    {
    }
}
