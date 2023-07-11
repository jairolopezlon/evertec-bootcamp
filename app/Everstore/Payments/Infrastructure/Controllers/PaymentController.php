<?php

namespace App\Everstore\Payments\Infrastructure\Controllers;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Payments\Application\Actions\ProcessPaymentAction;
use App\Everstore\Payments\Application\Actions\ProcessResponseAction;
use App\Everstore\Shared\Domain\Types\Types;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * @phpstan-import-type PaymentProviderAndOrderId from Types
 */
class PaymentController
{
    public function __construct(
        private readonly ProcessPaymentAction $processPaymentAction,
        private readonly ProcessResponseAction $processResponseAction
    ) {
    }

    public function processPayment(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'paymentProvider' => 'required|in:'.implode(',', PaymentProviderEnum::enumToArray()),
            'currency' => 'required|in:'.implode(',', PaymentCurrencyEnum::enumToArray()),
        ]);

        $shoppingCartData = $request->session()->get('shoppingCart');

        $paymentProvider = PaymentProviderEnum::enumFromValue($validatedData['paymentProvider']);
        $paymentCurrency = PaymentCurrencyEnum::enumFromValue($validatedData['currency']);

        return $this->processPaymentAction::execute($paymentProvider, $paymentCurrency, $shoppingCartData);
    }

    public function processResponse(Request $request): View
    {
        /** @var PaymentProviderAndOrderId */
        $paymentProviderAndOrderId = $request->query();
        $orderId = $paymentProviderAndOrderId['orderId'];
        $paymentProvider = $paymentProviderAndOrderId['paymentProvider'];
        $paymentResponseData = $this->processResponseAction::execute($orderId, $paymentProvider);

        if ($paymentResponseData['status'] === PaymentStatusEnum::COMPLETED->value) {
            return view('pages.ecommerce.payment.paymentResponseSuccess', compact('paymentResponseData'));
        }

        return view('pages.ecommerce.payment.paymentResponseFailure', compact('paymentResponseData'));
    }
}
