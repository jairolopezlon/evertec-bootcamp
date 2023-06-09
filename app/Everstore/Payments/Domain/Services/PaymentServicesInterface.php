<?php

namespace App\Everstore\Payments\Domain\Services;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Shared\Domain\Types\Types;
use Illuminate\Http\RedirectResponse;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 * @phpstan-import-type PaymentResponse from Types
 * @phpstan-import-type PaymentResponseData from Types
 */
interface PaymentServicesInterface
{
    /**
     * @param  ValidatedItemShoppingCartNative  $shoppingCartData
     */
    public function pay(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): RedirectResponse;

    public function getStatusModelAdapter(string $paymentStatusOfService): PaymentStatusEnum;

    /**
     * @return PaymentResponse
     */
    public function getPaymentInfo(string $requestId);

    /**
     * @return PaymentResponseData
     */
    public function paymentHandlerResponse(string $orderId);
}
