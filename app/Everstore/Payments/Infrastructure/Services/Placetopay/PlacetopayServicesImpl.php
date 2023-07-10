<?php

namespace App\Everstore\Payments\Infrastructure\Services\Placetopay;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Orders\Domain\Repositories\OrderRepositoryInterface;
use App\Everstore\Payments\Domain\Services\PaymentServicesInterface;
use App\Everstore\Payments\Infrastructure\Services\Placetopay\PlacetopayClient;
use App\Everstore\Shared\Domain\Types\Types;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
class PlacetopayServicesImpl implements PaymentServicesInterface
{
    public function __construct(
        private OrderRepositoryInterface $OrderRepository
    ) {
    }
    /**
     * @param ValidatedItemShoppingCartNative $shoppingCartData
     */
    public function pay(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): RedirectResponse {

        $order = $this->OrderRepository->createOrder($paymentProvider, $paymentCurrency, $shoppingCartData);
        $orderAttributes = $order->getAttributes();

        // $request = App::make(Request::class);
        // $request->session()->put('shoppingCart', ([]));

        $ip = Request()->ip();
        $userAgent = Request()->userAgent();
        $placetopayClient = new PlacetopayClient();
        $paymentOrderData = $placetopayClient->getPaymentOrderData(
            $orderAttributes['orderId'],
            "payment of order {$orderAttributes['orderId']}",
            $paymentCurrency->value,
            $orderAttributes['total'],
            route('ecommerce.payments.processResponse')
                . '?orderId=' . $orderAttributes['orderId']
                . '&paymentProvider=' . $paymentProvider->value,
            $ip,
            $userAgent
        );

        $orderPlacetoPay = $placetopayClient->createPaymentOrder($paymentOrderData);

        dd(Carbon::createFromDate('2023-07-08T02:46:17-05:00')->diffInMinutes(Carbon::now()), $orderPlacetoPay->json());

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
            'paymentUrl' => $paymentUrl,
            'paymentId' => $paymentId,
            'status' => $statusOrder,
        ]);

        $paymentMessage = $orderPlacetoPay->json()['status']['message'];
        $orderPlacetoPay->ok()
            ? Log::info("[PAY]: paymentServicesImpl - {$paymentMessage} ")
            : Log::error("[PAY]: paymentServicesImpl - {$paymentMessage} ");

        return redirect()->to($redirectTo);
    }

    public function getPaymentStatus(string $requestId)
    {
        $placetopayClient = new PlacetopayClient();
        return $placetopayClient->getPaymentStatus($requestId);
    }

    public function paymentHandlerResponse(string $orderId)
    {
        $order = $this->OrderRepository->getOrderById($orderId);
        $paymentInfo = $this->getPaymentStatus($order['paymentId']);
        $newStatus = $this->getStatusModelAdapter($paymentInfo->json()['status']['status']);
        $this->OrderRepository->updatePaymentInfo($orderId, ['status' => $newStatus]);

        dd(Carbon::now()->subMinutes(5), $paymentInfo->json());
    }

    public function getStatusModelAdapter(string $paymentStatusOfService): PaymentStatusEnum
    {
        $paymentStatus = '';

        switch ($paymentStatusOfService) {
            case 'APPROVED':
                $paymentStatus = PaymentStatusEnum::COMPLETED;
                break;
            case 'FAILED':
            case 'REJECTED':
            case 'PARTIAL_EXPIRED':
                $paymentStatus = PaymentStatusEnum::CANCELLED;
                break;
            case 'PENDING':
            case 'APPROVED_PARTIAL':
                $paymentStatus = PaymentStatusEnum::PROCESSING;
                break;
        }

        return $paymentStatus;
    }
}
