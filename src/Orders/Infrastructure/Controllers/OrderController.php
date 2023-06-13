<?php

namespace Src\Orders\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Src\Orders\Application\Actions\OrderCreateAction;
use Src\Orders\Domain\Enums\PaymentCurrencyEnum;
use Src\Orders\Domain\Enums\PaymentProviderEnum;
use Src\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderEntity;

class OrderController
{
    public function __construct(
        private readonly OrderCreateAction $orderCreateAction
    ) {
    }

    public function index(Request $request): View
    {
        $orders = EloquentOrderEntity::all();

        return view('pages.ecommerce.orders.orderList', compact('orders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'paymentProvider' => 'required|in:' . implode(',', PaymentProviderEnum::enumToArray()),
            'currency' => 'required|in:' . implode(',', PaymentCurrencyEnum::enumToArray())
        ]);

        $shoppingCartData = $request->session()->get('shoppingCart');

        $paymentProvider = PaymentProviderEnum::enumFromValue($validatedData['paymentProvider']);
        $paymentCurrency = PaymentCurrencyEnum::enumFromValue($validatedData['currency']);

        $orderData = ($this->orderCreateAction)($paymentProvider, $paymentCurrency, $shoppingCartData);

        return redirect()->route('ecommerce.orders.index');
    }
}
