<?php

namespace App\Everstore\Orders\Infrastructure\Controllers;

use App\Everstore\Orders\Application\Actions\OrderCreateAction;
use App\Everstore\Orders\Application\Actions\OrdersListByUserAction;
use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentProviderEnum;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController
{
    public function __construct(
        private readonly OrderCreateAction $orderCreateAction,
        private readonly OrdersListByUserAction $ordersListByUserAction
    ) {
    }

    public function index(Request $request): View
    {
        $ordersByUSer = ($this->ordersListByUserAction)();

        return view('pages.ecommerce.orders.orderList', compact('ordersByUSer'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'paymentProvider' => 'required|in:'.implode(',', PaymentProviderEnum::enumToArray()),
            'currency' => 'required|in:'.implode(',', PaymentCurrencyEnum::enumToArray()),
        ]);

        $shoppingCartData = $request->session()->get('shoppingCart');

        $paymentProvider = PaymentProviderEnum::enumFromValue($validatedData['paymentProvider']);
        $paymentCurrency = PaymentCurrencyEnum::enumFromValue($validatedData['currency']);

        $orderData = ($this->orderCreateAction)($paymentProvider, $paymentCurrency, $shoppingCartData);

        return redirect()->route('ecommerce.orders.index');
    }
}
