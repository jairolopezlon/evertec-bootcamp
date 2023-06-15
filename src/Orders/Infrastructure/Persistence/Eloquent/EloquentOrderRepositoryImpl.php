<?php

namespace Src\Orders\Infrastructure\Persistence\Eloquent;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Src\Orders\Domain\Enums\PaymentCurrencyEnum;
use Src\Orders\Domain\Enums\PaymentProviderEnum;
use Src\Orders\Domain\Enums\PaymentStatusEnum;
use Src\Orders\Domain\Models\Order;
use Src\Orders\Domain\Repositories\OrderRepositoryInterface;
use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderPrimitive from Types
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
class EloquentOrderRepositoryImpl implements OrderRepositoryInterface
{
    /**
     * @param  PaymentProviderEnum  $paymentProvider
     * @param  PaymentCurrencyEnum  $paymentCurrency
     * @param  ValidatedItemShoppingCartNative|array<mixed>  $shoppingCartData
     */
    public function createOrder($paymentProvider, $paymentCurrency, $shoppingCartData): Order
    {
        $totalOrder = array_reduce($shoppingCartData, function (float $acc, $cur) {
            return $acc + ($cur['price'] * $cur['amount']);
        }, 0);

        $orderEntity = new EloquentOrderEntity();

        $orderEntity->payment_provider = $paymentProvider->value;
        $orderEntity->user_id = Auth::user()->id;
        $orderEntity->total = $totalOrder;
        $orderEntity->payment_status = PaymentStatusEnum::NOT_STARTED->value;
        $orderEntity->currency = PaymentCurrencyEnum::USD->value;

        $orderEntity->save();

        $orderId = $orderEntity->id;

        $ordersDetail = array_map(function ($orderDetail) use ($orderId) {
            return [
                'order_id' => $orderId,
                'product_id' => $orderDetail['productId'],
                'product_name' => $orderDetail['name'],
                'product_price' => $orderDetail['price'],
                'quantity' => $orderDetail['amount'],
                'subtotal' => $orderDetail['subTotal'],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $shoppingCartData);

        DB::table('order_details')->insert($ordersDetail);

        $order = EloquentOrderAdapter::toDomainModel($orderEntity);

        return $order;
    }
}
