<?php

namespace Src\Checkout\Infrastructure\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Src\Checkout\Domain\Services\CheckoutServiceInterface;
use Src\Products\Infrastructure\Persistence\Eloquent\EloquentProductEntity;
use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 * @phpstan-import-type ItemShoppingCartNative from Types
 */
class CheckoutServiceImpl implements CheckoutServiceInterface
{
    /**
     * @return array<ValidatedItemShoppingCartNative>
     */
    public function validateProductInShoppingCart()
    {
        $request = App::make(Request::class);

        $shoppingCartSessionData = $request->session()->get('shoppingCart');

        $idItemsCart = array_map(function (array $itemShoppingCartNative): int {
            return $itemShoppingCartNative['productId'];
        }, array_values($shoppingCartSessionData));

        $productsData = EloquentProductEntity::whereIn('id', $idItemsCart)->get();

        $dataValidated = $productsData->map(function ($product) use ($shoppingCartSessionData) {
            $price = (float) $product->price;
            /**
             * @var ValidatedItemShoppingCartNative
             */
            $productInCart = $shoppingCartSessionData[$product->id];

            if (! $product->has_availability) {
                $productInCart['validation'][] = 'the product is out of stock';

                return $productInCart;
            }

            if ($product->stock < $productInCart['amount']) {
                $productInCart['validation'][] = "now only {$product->stock} units left";
                $productInCart['currentStock'] = $product->stock;
            }

            if ($price !== $productInCart['price']) {
                if ($price < $productInCart['price']) {
                    $productInCart['validation'][] = "the product decreased in price, current price {$price}";
                } else {
                    $productInCart['validation'][] = "the product increased in price, current price {$price}";
                }
                $productInCart['oldPrice'] = $productInCart['price'];
                $productInCart['price'] = $price;
                $productInCart['subTotal'] = $price * $productInCart['amount'];
            }

            return $productInCart;
        })->toArray();

        return $dataValidated;
    }
}
