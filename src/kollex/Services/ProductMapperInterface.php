<?php

namespace kollex\Services;

use kollex\Dataprovider\Assortment\Product;

interface ProductMapperInterface
{
    public function execute(array $productData): array;
}