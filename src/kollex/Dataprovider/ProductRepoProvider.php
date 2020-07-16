<?php

namespace kollex\Dataprovider;

use kollex\Services\FileServiceInterface;
use kollex\Services\ProductFromAMapper;
use kollex\Services\ProductFromBMapper;

class ProductRepoProvider implements ProductRepoProviderInterface
{
    /** @var FileServiceInterface */
    private $fileService;

    /**
     * ProductRepoProvider constructor.
     * @param FileServiceInterface $fileService
     */
    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @inheritDoc
     */
    public function getRepo(string $fileType): ProductRepoInterface
    {
        switch (strtolower($fileType)) {
            case 'json':
                return new ProductRepoJSON($this->fileService, new ProductFromBMapper());
            case 'csv':
                return new ProductRepoCSV($this->fileService, new ProductFromAMapper());
        }
    }
}