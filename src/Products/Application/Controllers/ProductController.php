<?php

namespace Src\Products\Application\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Src\Products\Application\Actions\DetailEcommerceProductsAction;
use Src\Products\Application\Actions\ListEcommerceProductsAction;
use Src\Products\Application\Actions\MatchEcommerceProductsAction;

/**
 * @phpstan-type FilterItem array{value: string, field: string}
 * @phpstan-type SearchParams array{filters?: FilterItem[], sort?: string, limit?: string, offset?: string}
 */
class ProductController extends Controller
{
    public function __construct(
        private ListEcommerceProductsAction $listEcommerceProductsAction,
        private DetailEcommerceProductsAction $detailEcommerceProductsAction,
        private MatchEcommerceProductsAction $matchEcommerceProductsAction
    ) {
        $this->listEcommerceProductsAction = $listEcommerceProductsAction;
        $this->detailEcommerceProductsAction = $detailEcommerceProductsAction;
        $this->matchEcommerceProductsAction = $matchEcommerceProductsAction;
    }

    public function listEcommerceProducts(Request $request): View
    {
        $products = $this->listEcommerceProductsAction->handle();

        return view('pages.ecommerce.products.productsList', compact('products'));
    }

    public function detailEcommerceProducts(string $slug): View
    {
        $product = $this->detailEcommerceProductsAction->handle($slug);

        return view('pages.ecommerce.products.productDetail', compact('product'));
    }

    public function matchEcommerceProducts(Request $request): View
    {
        /** @var SearchParams */
        $searchParams = $request->query();

        $products = ($this->matchEcommerceProductsAction)($searchParams);

        return view('pages.ecommerce.products.productsList', compact('products'));
    }
}
