<?php

namespace kollex\Dataprovider\Assortment;

use kollex\Services\FileServiceInterface;
use kollex\Dataprovider\ProductRepoInterface;
use kollex\Dataprovider\ProductRepoProviderInterface;

class ProductProvider implements DataProvider
{
    /** @var FileServiceInterface */
    private $fileService;

    /** @var ProductRepoProviderInterface */
    private $productRepoProvider;

    public function __construct(
        FileServiceInterface $fileService,
        ProductRepoProviderInterface $productRepoProvider
    )
    {
        $this->fileService = $fileService;
        $this->productRepoProvider = $productRepoProvider;
    }

    /**
     * @param string $path
     * @return ProductInterface[]
     */
    public function getProducts(string $path): array
    {
        $fileType = $this->fileService->getFileExtension($path);

        /** @var ProductRepoInterface */
        $productRepo = $this->productRepoProvider->getRepo($fileType);

        return $productRepo->getProducts($path);
    }
}