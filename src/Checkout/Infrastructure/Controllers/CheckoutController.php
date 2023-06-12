<?php

namespace Src\Checkout\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Src\Checkout\Application\Actions\ValidationShoppingCartITemsAction;

class CheckoutController
{
    public function __construct(
        private readonly ValidationShoppingCartITemsAction $validationShoppingCartITemsAction
    ) {
    }

    public function index(): View|RedirectResponse
    {
        $itemsCartValidated = ($this->validationShoppingCartITemsAction)();

        if (count($itemsCartValidated) === 0) {
            return back();
        }

        $messagesOfValidation = array_reduce($itemsCartValidated, function ($acc, $cur) {
            if (isset($cur['validation'])) {
                $acc = [...$acc, ...$cur['validation']];
            }

            return $acc;
        }, []);

        return view('pages.ecommerce.checkout.checkout', compact('messagesOfValidation'));
    }
}
