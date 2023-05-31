<?php

namespace Src\Products\Domain\Repositories;

interface ProductRepository
{
    public function ListEcommerceProducts();

    public function GetEcommerceProductDetail(string $slug);
}
