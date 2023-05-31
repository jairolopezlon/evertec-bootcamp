<?php

namespace Src\Products\Application\Controllers;

use App\Http\Controllers\Controller;
use Src\Products\Application\Actions\DetailEcommerceProductsAction;
use Src\Products\Application\Actions\ListEcommerceProductsAction;

class ProductController extends Controller
{
    private $listEcommerceProductsAction;

    private $detailEcommerceProductsAction;

    public function __construct(
        ListEcommerceProductsAction $listEcommerceProductsAction,
        DetailEcommerceProductsAction $detailEcommerceProductsAction
    ) {
        $this->listEcommerceProductsAction = $listEcommerceProductsAction;
        $this->detailEcommerceProductsAction = $detailEcommerceProductsAction;
    }

    public function listEcommerceProducts()
    {
        $products = $this->listEcommerceProductsAction->handle();

        return view('pages.ecommerce.products.productsList', compact('products'));
    }

    public function detailEcommerceProducts(string $slug)
    {
        $product = $this->detailEcommerceProductsAction->handle($slug);

        return view('pages.ecommerce.products.productDetail', compact('product'));
    }
}
