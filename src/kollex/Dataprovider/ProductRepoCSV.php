<?php

namespace kollex\Dataprovider;

use kollex\Dataprovider\Assortment\Product;
use kollex\Services\FileServiceInterface;
use kollex\Services\ProductMapperInterface;

class ProductRepoCSV implements ProductRepoInterface
{
    /** @var FileServiceInterface */
    private $fileService;

    /** @var ProductMapperInterface */
    private $productMapper;

    public function __construct(
        FileServiceInterface $fileService,
        ProductMapperInterface $productTransformer
    ) {
        $this->fileService = $fileService;
        $this->productMapper = $productTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getProducts(string $path): array
    {
        $products = [];
        $lineNUmber = 0;

        foreach ($this->fileService->readTheFile($path) as $row) {
            if ($lineNUmber > 0) {
                try {
                    $productArray = $this->productMapper->execute(str_getcsv($row, ';'));

                    $product = new Product();

                    $product->setId($productArray['id']);
                    $product->setManufacturer($productArray['manufacturer']);
                    $product->setName($productArray['name']);
                    $product->setPackaging($productArray['packaging']);
                    $product->setBaseProductPackaging($productArray['baseProductPackaging']);
                    $product->setBaseProductUnit($productArray['baseProductUnit']);
                    $product->setBaseProductAmount((float) $productArray['baseProductAmount']);
                    $product->setBaseProductQuantity((int) $productArray['baseProductQuantity']);

                    $products[] = $product;
                } catch (\Exception $e) {
                    //TODO: Log validation errors
                }
            }

            $lineNUmber++;
        }

        return $products;
    }
}