<?php

namespace kollex\Dataprovider;

use kollex\Dataprovider\Assortment\Product;
use kollex\Services\FileServiceInterface;
use kollex\Services\ProductMapperInterface;

class ProductRepoJSON implements ProductRepoInterface
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
        $rawData = '';

        foreach ($this->fileService->readTheFile($path) as $row) {
            if (strpos($row, '{') !== false) {
                $rawData = $row;
                continue;
            }

            $rawData .= $row;

            if (strpos($row, '}') !== false) {
                if (strpos($row, ',') !== false) {
                    $rawData = rtrim($rawData, ',');
                }

                $productData = json_decode($rawData,true);

                try {
                    if ($productData) {
                        $productArray = $this->productMapper->execute($productData);

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
                    }
                } catch (\Exception $e) {
                    //TODO: Log validation errors
                    echo ' - ' . $e->getMessage();
                }

                $rawData = '';
            }
        }

        return $products;
    }
}