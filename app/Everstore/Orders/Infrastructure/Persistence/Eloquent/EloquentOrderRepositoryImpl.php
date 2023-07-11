<?php

namespace App\Everstore\Orders\Infrastructure\Persistence\Eloquent;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Orders\Domain\Models\Order;
use App\Everstore\Orders\Domain\Repositories\OrderRepositoryInterface;
use App\Everstore\Shared\Domain\Types\Types;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 * @phpstan-import-type PaymentInfo from Types
 * @phpstan-import-type OrderPrimitive from Types
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

    /**
     * @return array<Order>
     */
    public function listOrdersByUser(): array
    {
        $userId = Auth::user()->id;
        $orders = EloquentOrderEntity::where('user_id', $userId)->get();

        $orderByUser = $orders->map(function (EloquentOrderEntity $orderEntity) {
            return EloquentOrderAdapter::toDomainModel($orderEntity);
        })->toArray();

        return $orderByUser;
    }

    /**
     * @param  PaymentInfo  $paymentInfo
     */
    public function updatePaymentInfo(string $orderId, array $paymentInfo): void
    {
        $orderEntity = EloquentOrderEntity::where('id', $orderId)->first();

        if (isset($paymentInfo['status'])) {
            $orderEntity->payment_status = $paymentInfo['status'];
        }
        if (isset($paymentInfo['paymentId'])) {
            $orderEntity->payment_id = $paymentInfo['paymentId'];
        }
        if (isset($paymentInfo['paymentUrl'])) {
            $orderEntity->payment_url = $paymentInfo['paymentUrl'];
        }

        $orderEntity->save();
    }

    /**
     * @return OrderPrimitive
     */
    public function getOrderById(string $orderId)
    {
        $orderEntity = EloquentOrderEntity::where('id', $orderId)->first();

        $order = EloquentOrderAdapter::toDomainModel($orderEntity);

        return $order->getAttributes();
    }
}
