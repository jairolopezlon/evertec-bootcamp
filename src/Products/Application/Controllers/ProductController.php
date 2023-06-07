<?php

namespace Src\Products\Application\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Products\Application\Actions\DetailEcommerceProductsAction;
use Src\Products\Application\Actions\ListEcommerceProductsAction;
use Src\Products\Application\Actions\MatchEcommerceProductsAction;

class ProductController extends Controller
{
    private $listEcommerceProductsAction;

    private $detailEcommerceProductsAction;

    private $matchEcommerceProductsAction;

    public function __construct(
        ListEcommerceProductsAction $listEcommerceProductsAction,
        DetailEcommerceProductsAction $detailEcommerceProductsAction,
        MatchEcommerceProductsAction $matchEcommerceProductsAction
    ) {
        $this->listEcommerceProductsAction = $listEcommerceProductsAction;
        $this->detailEcommerceProductsAction = $detailEcommerceProductsAction;
        $this->matchEcommerceProductsAction = $matchEcommerceProductsAction;
    }

    public function listEcommerceProducts(Request $request)
    {
        $products = $this->listEcommerceProductsAction->handle();

        return view('pages.ecommerce.products.productsList', compact('products'));
    }

    public function detailEcommerceProducts(string $slug)
    {
        $product = $this->detailEcommerceProductsAction->handle($slug);

        return view('pages.ecommerce.products.productDetail', compact('product'));
    }

    public function matchEcommerceProducts(Request $request)
    {
        $searchParams = $request->query();

        $products = ($this->matchEcommerceProductsAction)($searchParams);

        return view('pages.ecommerce.products.productsList', compact('products'));
    }
}
