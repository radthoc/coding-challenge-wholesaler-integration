<?php


namespace kollex\Dataprovider\Assortment;


interface DataProvider
{
    /**
     * @param string $path
     * @return ProductInterface[]
     */
    public function getProducts(string $path): array;
}
