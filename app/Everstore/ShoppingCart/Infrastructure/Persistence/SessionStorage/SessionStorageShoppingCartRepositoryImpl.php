<?php

namespace App\Everstore\ShoppingCart\Infrastructure\Persistence\SessionStorage;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;
use App\Everstore\Shared\Domain\Types\Types;
use App\Everstore\ShoppingCart\Domain\Dtos\ItemsShoppingCartData;
use App\Everstore\ShoppingCart\Domain\Models\ItemShoppingCart;
use App\Everstore\ShoppingCart\Domain\Models\ShoppingCart;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * @phpstan-import-type ItemShoppingCartNative from Types
 */
class SessionStorageShoppingCartRepositoryImpl implements ShoppingCartRepositoryInterface
{
    public function getItems(): ShoppingCart
    {
        $request = App::make(Request::class);

        /** @var array<string, ItemShoppingCartNative>|null */
        $shoppingCartSessionData = $request->session()->get('shoppingCart');

        if (is_null($shoppingCartSessionData) || gettype($shoppingCartSessionData) !== 'array') {
            $shoppingCartSessionData = ([]);
            $request->session()->put('shoppingCart', $shoppingCartSessionData);
        }

        $itemsShoppingCart = array_map(function ($item) {
            return new ItemShoppingCart(
                new ProductId($item['productId']),
                $item['name'],
                $item['description'],
                $item['slug'],
                $item['imageUrl'],
                $item['price'],
                $item['subTotal'],
                $item['amount'],
            );
        }, $shoppingCartSessionData);

        return new ShoppingCart($itemsShoppingCart);
    }

    public function addItem(ItemShoppingCart $itemShoppingCart): ShoppingCart
    {
        $shoppingCart = $this->getItems();
        $productId = $itemShoppingCart->getProductId();

        if ($shoppingCart->hasItem($productId)) {
            $shoppingCart->getItem($productId)->incrementAmount($itemShoppingCart->getAmount());
        } else {
            $shoppingCart->addItemCart($itemShoppingCart);
        }

        $shoppingCartSessionData = (new ItemsShoppingCartData($shoppingCart))->toArray();
        $request = App::make(Request::class);
        $request->session()->put('shoppingCart', $shoppingCartSessionData);

        return $shoppingCart;
    }

    public function removeItem(ProductId $productId): ShoppingCart
    {
        $shoppingCart = $this->getItems();

        if ($shoppingCart->hasItem($productId)) {
            $shoppingCart->removeItemCart($productId);
        }

        $shoppingCartSessionData = (new ItemsShoppingCartData($shoppingCart))->toArray();
        $request = App::make(Request::class);
        $request->session()->put('shoppingCart', $shoppingCartSessionData);

        return $shoppingCart;
    }

    public function incrementItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCart
    {
        $shoppingCart = $this->getItems();

        $productId = $itemShoppingCart->getProductId();

        if ($shoppingCart->hasItem($productId)) {
            $shoppingCart->getItem($productId)->incrementAmount($itemShoppingCart->getAmount());
        } else {
            $shoppingCart->addItemCart($itemShoppingCart);
        }

        $shoppingCartSessionData = (new ItemsShoppingCartData($shoppingCart))->toArray();
        $request = App::make(Request::class);
        $request->session()->put('shoppingCart', $shoppingCartSessionData);

        return $shoppingCart;
    }

    public function decrementItemAmount(ProductId $productId, int $amount): ShoppingCart
    {
        $shoppingCart = $this->getItems();

        if ($shoppingCart->hasItem($productId)) {
            $itemShoppingCart = $shoppingCart->getItem($productId);
            $itemShoppingCart->decrementAmount($amount);

            if ($itemShoppingCart->getAmount() <= 0) {
                $shoppingCart->removeItemCart($productId);
            }
        }

        $shoppingCartSessionData = (new ItemsShoppingCartData($shoppingCart))->toArray();
        $request = App::make(Request::class);
        $request->session()->put('shoppingCart', $shoppingCartSessionData);

        return $shoppingCart;
    }

    public function setItemAmount(ItemShoppingCart $itemShoppingCart): ShoppingCart
    {
        $shoppingCart = $this->getItems();

        $productId = $itemShoppingCart->getProductId();

        if ($shoppingCart->hasItem($productId)) {
            $shoppingCart->getItem($productId)->setAmount($itemShoppingCart->getAmount());
        } else {
            $shoppingCart->addItemCart($itemShoppingCart);
        }

        $shoppingCartSessionData = (new ItemsShoppingCartData($shoppingCart))->toArray();
        $request = App::make(Request::class);
        $request->session()->put('shoppingCart', $shoppingCartSessionData);

        return $shoppingCart;
    }

    public function removeAllItems(): void
    {
        $request = App::make(Request::class);

        $shoppingCartSessionData = ([]);
        $request->session()->put('shoppingCart', $shoppingCartSessionData);
    }
}
