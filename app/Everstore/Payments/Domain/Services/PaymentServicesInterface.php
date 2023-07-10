<?php

namespace App\Everstore\Payments\Domain\Services;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Orders\Domain\Models\Order;
use App\Everstore\Shared\Domain\Types\Types;
use Illuminate\Http\RedirectResponse;

/**
 * @phpstan-import-type ValidatedItemShoppingCartNative from Types
 */
interface PaymentServicesInterface
{
    /**
     * @param ValidatedItemShoppingCartNative $shoppingCartData
     */
    public function pay(
        PaymentProviderEnum $paymentProvider,
        PaymentCurrencyEnum $paymentCurrency,
        $shoppingCartData
    ): RedirectResponse;

    public function getStatusModelAdapter(string $paymentStatusOfService): PaymentStatusEnum;
    public function getPaymentStatus(string $requestId);
    public function paymentHandlerResponse(string $orderId);
}
