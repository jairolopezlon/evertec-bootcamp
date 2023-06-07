<?php

namespace Src\Products\Infrastructure\Repository\Eloquent;

use Illuminate\Support\Facades\Schema;
use Src\Domain\ValueObjects\CriteriaValue;
use Src\Products\Domain\Dtos\ProductDetailEcommerceData;
use Src\Products\Domain\Dtos\ProductListEcommerceData;
use Src\Products\Domain\Repositories\ProductRepository;

class EloquentProductRespositoryImpl implements ProductRepository
{
    private $productModel;

    public function __construct(EloquentProductEntity $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * @return array<ProductListEcommerceData>
     */
    public function listEcommerceProducts()
    {
        $enableProducts = $this->productModel::where('is_enable', true)->get();
        $listProducts = $enableProducts->map(function ($product) {
            $productModel = EloquentProductAdapter::toDomainModel($product);

            return new ProductListEcommerceData($productModel);
        });

        return $listProducts;
    }

    /**
     * @return ProductDetailEcommerceData
     */
    public function getEcommerceProductDetail($slug)
    {
        $product = $this->productModel::where('slug', $slug)->first();
        $productModel = EloquentProductAdapter::toDomainModel($product);
        $productData = new ProductDetailEcommerceData($productModel);

        return $productData;
    }

    public function matchEcommerceProducts(CriteriaValue $criteriaValue)
    {
        $query = $this->productModel::where('is_enable', true);

        if ($criteriaValue->validateThereAreFilters()) {
            $filters = $criteriaValue->getFilters();

            foreach ($filters as $filter) {
                $field = $filter->getField();
                $value = $filter->getValue();

                if ($field === 'searchText') {
                    //include fields name (colums name) where want to search
                    $nameField = 'name';
                    $descriptionField = 'description';

                    $query->where(function ($query) use ($nameField, $descriptionField, $value) {
                        $query->where($nameField, 'LIKE', '%'.$value.'%')
                            ->orWhere($descriptionField, 'LIKE', '%'.$value.'%');
                    });

                    continue;
                }

                if (! Schema::hasColumn($this->productModel->getTable(), $field)) {
                    continue;
                }

                $query->where($field, $value);
            }
        }

        $sortCriteria = $criteriaValue->getSort();
        if (! is_null($sortCriteria)) {
            $sortDirection = $sortCriteria->getDirection()->value;
            $sortField = $sortCriteria->getField();
            if (Schema::hasColumn($this->productModel->getTable(), $sortField)) {
                $query->orderBy($sortField, $sortDirection);
            }
        }

        $limit = $criteriaValue->getLimit();
        $offset = $criteriaValue->getOffset();
        $matchProducts = $query->paginate($limit, ['*'], 'page', $offset);

        $matchProducts->appends(request()->query());

        $productsData = $matchProducts->map(function ($product) {
            $productModel = EloquentProductAdapter::toDomainModel($product);

            return new ProductListEcommerceData($productModel);
        })->toArray();

        $paginateProductList = $matchProducts->jsonSerialize();
        $paginateProductList['data'] = $productsData;
        $paginateProductList['criteriaLinks'] = [
            'searchText' => route(
                'ecommerce.products.productsList',
                array_merge(request()->except(['sort', 'page']))
            ),
            'sortByPriceAsc' => route(
                'ecommerce.products.productsList',
                array_merge(request()->except(['sort', 'page']), ['sort' => 'price'])
            ),
            'sortByPriceDesc' => route(
                'ecommerce.products.productsList',
                array_merge(request()->except(['sort', 'page']), ['sort' => '-price'])
            ),
            'sortByNameAsc' => route(
                'ecommerce.products.productsList',
                array_merge(request()->except(['sort', 'page']), ['sort' => 'name'])
            ),
            'sortByNameDesc' => route(
                'ecommerce.products.productsList',
                array_merge(request()->except(['sort', 'page']), ['sort' => '-name'])
            ),
        ];

        return $paginateProductList;
    }
}