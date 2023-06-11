<?php

namespace Src\Checkout\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Src\Checkout\Application\Actions\ValidationShoppingCartITemsAction;

class CheckoutController
{
    public function __construct(
        private readonly ValidationShoppingCartITemsAction $validationShoppingCartITemsAction
    ) {
    }

    public function index(): View
    {
        $itemsCartValidated = ($this->validationShoppingCartITemsAction)();

        return view('pages.ecommerce.checkout.checkout', compact('itemsCartValidated'));
    }
}
