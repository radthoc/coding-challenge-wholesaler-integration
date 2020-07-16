<?php

namespace test\Unit;

use kollex\Dataprovider\ProductRepoCSV;
use kollex\Dataprovider\ProductRepoJSON;
use kollex\Dataprovider\ProductRepoProvider;
use kollex\Services\FileService;
use PHPUnit\Framework\TestCase;

class ProductRepoProviderTest extends TestCase
{
    /** @var ProductRepoProvider */
    private $productRepoProvider;

    public function setUp()
    {
        parent::setUp();

        $this->productRepoProvider = new ProductRepoProvider(new FileService());
    }

    /**
     * test that the repo provider provides the csv repo
     */
    public function testProvideCSVRepo() {
        $repo = $this->productRepoProvider->getRepo('csv');

        $this->assertInstanceOf(ProductRepoCSV::class, $repo);
    }

    /**
     * test that the repo provider provides the json repo
     */
    public function testProvideJSONRepo() {
        $repo = $this->productRepoProvider->getRepo('json');

        $this->assertInstanceOf(ProductRepoJSON::class, $repo);
    }
}