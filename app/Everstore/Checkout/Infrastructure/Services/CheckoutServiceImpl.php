<?php

namespace App\Everstore\Checkout\Infrastructure\Services;

use App\Everstore\Checkout\Domain\Services\CheckoutServiceInterface;
use App\Everstore\Products\Infrastructure\Persistence\Eloquent\EloquentProductEntity;
use App\Everstore\Shared\Domain\Types\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 * @phpstan-import-type ItemShoppingCartNative from Types
 * @phpstan-import-type CheckoutDataToUpdate from Types
 */
class CheckoutServiceImpl implements CheckoutServiceInterface
{
    /**
     * @return array<ValidatedItemShoppingCartNative>
     */
    public function validateProductInShoppingCart()
    {
        $request = App::make(Request::class);

        $shoppingCartSessionData = $request->session()->get('shoppingCart', []);

        $idItemsCart = array_map(function (array $itemShoppingCartNative): int {
            return $itemShoppingCartNative['productId'];
        }, array_values($shoppingCartSessionData));

        $productsData = EloquentProductEntity::whereIn('id', $idItemsCart)->get();

        $dataValidated = $productsData->map(function ($product) use ($shoppingCartSessionData) {
            $productId = $product->id;
            $price = (float) $product->price;
            $stock = (int) $product->stock;

            /**
             * @var ValidatedItemShoppingCartNative
             */
            $productInCart = $shoppingCartSessionData[$productId];

            if (! $product->has_availability) {
                $productInCart['validation'][] =
                    "The product \"{$product->name}\" is out of stock, the item was remove of cart";
                $this->removeItemShoppingCartData($productId);

                return $productInCart;
            }
            /**
             * @var CheckoutDataToUpdate
             */
            $dataToUpdate = [];

            if ($stock < $productInCart['amount']) {
                $productInCart['validation'][] = "Of the product \"{$product->name}\" now only {$stock} units left";
                $productInCart['oldAmount'] = $productInCart['amount'];
                $productInCart['amount'] = $stock;

                $dataToUpdate['amount'] = $productInCart['amount'];
            }

            if ($price !== $productInCart['price']) {
                if ($price < $productInCart['price']) {
                    $productInCart['validation'][] =
                        "The product \"{$product->name}\" decreased in price, current price \${$price}";
                } else {
                    $productInCart['validation'][] =
                        "The product \"{$product->name}\" increased in price, current price \${$price}";
                }

                $productInCart['oldPrice'] = $productInCart['price'];
                $productInCart['price'] = $price;
                $productInCart['subTotal'] = $price * $productInCart['amount'];

                $dataToUpdate['price'] = $productInCart['price'];
                $dataToUpdate['subTotal'] = $productInCart['subTotal'];
            }

            if (count($dataToUpdate) > 0) {
                $this->updateShoppingCart($productId, $dataToUpdate);
            }

            return $productInCart;
        })->toArray();

        return $dataValidated;
    }

    /**
     * @param  CheckoutDataToUpdate  $data
     */
    private function updateShoppingCart(int $productId, $data): void
    {
        $request = App::make(Request::class);

        $shoppingCartSessionData = $request->session()->get('shoppingCart');

        if (isset($data['price'])) {
            $shoppingCartSessionData[$productId]['price'] = $data['price'];
        }

        if (isset($data['amount'])) {
            $shoppingCartSessionData[$productId]['amount'] = $data['amount'];
        }

        $request->session()->put('shoppingCart', $shoppingCartSessionData);
    }

    private function removeItemShoppingCartData(int $productId): void
    {
        $request = App::make(Request::class);

        $shoppingCartSessionData = $request->session()->get('shoppingCart');

        unset($shoppingCartSessionData[$productId]);

        $request->session()->put('shoppingCart', $shoppingCartSessionData);
    }
}
