<?php

namespace App\Everstore\Payments\Infrastructure\Services\Placetopay;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Orders\Domain\Repositories\OrderRepositoryInterface;
use App\Everstore\Payments\Domain\Services\PaymentServicesInterface;
use App\Everstore\Shared\Domain\Types\Types;
use App\Everstore\ShoppingCart\Domain\Repositories\ShoppingCartRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * @phpstan-import-type OrderPrimitive from Types
 * @phpstan-import-type PaymentResponse from Types
 * @phpstan-import-type PaymentResponseData from Types
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
class PlacetopayServicesImpl implements PaymentServicesInterface
{
    public function __construct(
        private OrderRepositoryInterface $OrderRepository,
        private ShoppingCartRepositoryInterface $shoppingCartRepository
    ) {
    }

    /**
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     */
    public function pay(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): RedirectResponse {
        $order = $this->OrderRepository->createOrder($paymentProvider, $paymentCurrency, $shoppingCartData);
        $orderAttributes = $order->getAttributes();

        $this->shoppingCartRepository->removeAllItems();

        $ip = Request()->ip();
        $userAgent = Request()->userAgent();
        $placetopayClient = new PlacetopayClient();
        $paymentOrderData = $placetopayClient->getPaymentOrderData(
            $orderAttributes['orderId'],
            "payment of order {$orderAttributes['orderId']}",
            $paymentCurrency->value,
            $orderAttributes['total'],
            route('ecommerce.payments.processResponse')
                .'?orderId='.$orderAttributes['orderId']
                .'&paymentProvider='.$paymentProvider->value,
            $ip,
            $userAgent
        );

        $orderPlacetoPay = $placetopayClient->createPaymentOrder($paymentOrderData);

        $redirectTo = route('ecommerce.orders.index');
        $paymentId = null;
        $paymentUrl = null;
        $statusOrder = $this->getStatusModelAdapter('FAILED');

        if ($orderPlacetoPay->ok()) {
            $statusOrder = $this->getStatusModelAdapter('PENDING');
            $redirectTo = $orderPlacetoPay->json()['processUrl'];
            $paymentUrl = $orderPlacetoPay->json()['processUrl'];
            $paymentId = $orderPlacetoPay->json()['requestId'];
        }

        $this->OrderRepository->updatePaymentInfo($orderAttributes['orderId'], [
            'status' => $statusOrder->value,
            'paymentId' => $paymentId,
            'paymentUrl' => $paymentUrl,
        ]);

        $paymentMessage = $orderPlacetoPay->json()['status']['message'];
        $orderPlacetoPay->ok()
            ? Log::info("[PAY]: paymentServicesImpl - {$paymentMessage} ")
            : Log::error("[PAY]: paymentServicesImpl - {$paymentMessage} ");

        return redirect()->to($redirectTo);
    }

    /**
     * @return PaymentResponse
     */
    public function getPaymentInfo(string $requestId)
    {
        $placetopayClient = new PlacetopayClient();

        return $placetopayClient->getPaymentStatus($requestId);
    }

    /**
     * @return PaymentResponseData
     */
    public function paymentHandlerResponse(string $orderId): array
    {
        /** @var OrderPrimitive */
        $order = $this->OrderRepository->getOrderById($orderId);

        /** @var PaymentResponse */
        $paymentInfo = $this->getPaymentInfo($order['paymentId']);
        $newStatus = $this->getStatusModelAdapter($paymentInfo['status']);
        $this->OrderRepository->updatePaymentInfo($orderId, ['status' => $newStatus->value]);

        $paymentData = [
            'status' => $newStatus->value,
            'message' => $paymentInfo['message'],
            'orderId' => $orderId,
        ];

        return $paymentData;
    }

    public function getStatusModelAdapter(string $paymentStatusOfService): PaymentStatusEnum
    {
        $paymentStatus = PaymentStatusEnum::enumFromValue('NOT_STARTED');

        switch ($paymentStatusOfService) {
            case 'APPROVED':
                $paymentStatus = PaymentStatusEnum::enumFromValue('COMPLETED');
                break;
            case 'FAILED':
            case 'REJECTED':
            case 'PARTIAL_EXPIRED':
                $paymentStatus = PaymentStatusEnum::enumFromValue('CANCELLED');
                break;
            case 'PENDING':
            case 'APPROVED_PARTIAL':
                $paymentStatus = PaymentStatusEnum::enumFromValue('PROCESSING');
                break;
        }

        return $paymentStatus;
    }
}
