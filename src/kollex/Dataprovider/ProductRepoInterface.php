<?php

namespace kollex\Dataprovider;

use kollex\Dataprovider\Assortment\ProductInterface;

interface ProductRepoInterface
{
    /**
     * @param string $path
     * @return ProductInterface[]
     */
    public function getProducts(string $path): array;
}