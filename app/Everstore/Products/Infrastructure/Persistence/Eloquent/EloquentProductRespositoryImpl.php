<?php

namespace App\Everstore\Products\Infrastructure\Persistence\Eloquent;

use App\Everstore\Products\Domain\Dtos\ProductDetailEcommerceData;
use App\Everstore\Products\Domain\Dtos\ProductListEcommerceData;
use App\Everstore\Products\Domain\Repositories\ProductRepository;
use App\Everstore\Shared\Domain\ValueObjects\CriteriaSortValue;
use App\Everstore\Shared\Domain\ValueObjects\CriteriaValue;
use Illuminate\Support\Facades\Schema;

class EloquentProductRespositoryImpl implements ProductRepository
{
    public function __construct(private EloquentProductEntity $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * @return array<ProductListEcommerceData>
     */
    public function listEcommerceProducts(): array
    {
        $enableProducts = $this->productModel::where('is_enabled', true)->where('has_availability', true)->get();
        $listProducts = array_map(function ($product) {
            $productModel = EloquentProductAdapter::toDomainModel($product);

            return new ProductListEcommerceData($productModel);
        }, $enableProducts->toArray());

        return $listProducts;
    }

    public function getEcommerceProductDetail(string $slug): ProductDetailEcommerceData
    {
        $product = $this->productModel::where('slug', $slug)->first();
        $productModel = EloquentProductAdapter::toDomainModel($product);
        $productData = new ProductDetailEcommerceData($productModel);

        return $productData;
    }

    /**
     * @return array<ProductListEcommerceData>
     */
    public function matchEcommerceProducts(CriteriaValue $criteriaValue): array
    {
        $query = $this->productModel::where('is_enabled', true)->where('has_availability', true);

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
        /** @var CriteriaSortValue|null */
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
