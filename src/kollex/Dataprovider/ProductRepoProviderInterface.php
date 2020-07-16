<?php

namespace kollex\Dataprovider;

interface ProductRepoProviderInterface
{
    /**
     * @param string $fileType
     * @return ProductRepoInterface
     */
    public function getRepo(string $fileType): ProductRepoInterface;
}