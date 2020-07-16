<?php

namespace tests\Unit;

use kollex\Dataprovider\Assortment\Product;
use kollex\Dataprovider\Assortment\ProductProvider;
use kollex\Services\FileService;
use kollex\Dataprovider\ProductRepoProvider;
use Tests\TestCase;

class ProductProviderTest extends TestCase
{
    /** @var ProductProvider */
    private $productProvider;

    public function setup()
    {
        parent::setup();

        $fileService = new FileService();
        $productRepoProvider = new ProductRepoProvider($fileService);

        $this->productProvider = new ProductProvider($fileService, $productRepoProvider);
    }

    /**
     * Test getting a products array from the csv file
     */
    public function testGetProductsFromCSVFile()
    {
        $path = base_path() .
            DIRECTORY_SEPARATOR .
            'data' .
            DIRECTORY_SEPARATOR .
            'wholesaler_a.csv';

        $this->assertEquals(
            $this->getExpectedProductsFromA(),
            $this->productProvider->getProducts($path)
        );
    }

    /**
     * Test getting a products array from the json file
     */
    public function testGetProductsFromJSONFile()
    {
        $path = base_path() .
            DIRECTORY_SEPARATOR .
            'data' .
            DIRECTORY_SEPARATOR .
            'wholesaler_b.json';

        $this->assertEquals(
            $this->getExpectedProductsFromB(),
            $this->productProvider->getProducts($path)
        );
    }

    private function getExpectedProductsFromA()
    {
        $products = [];

        $product1 = new Product();
        $product1->setId('12345600001');
        $product1->setManufacturer('Drinks Corp.');
        $product1->setName('Soda Drink, 12 * 1,0l');
        $product1->setPackaging('CA');
        $product1->setBaseProductPackaging('BO');
        $product1->setBaseProductUnit('LT');
        $product1->setBaseProductAmount(1);
        $product1->setBaseProductQuantity(123);
        $products[] = $product1;

        $product2 = new Product();
        $product2->setId('12345600002');
        $product2->setManufacturer('Drinks Corp.');
        $product2->setName('Orange Drink, 20 * 0,5l');
        $product2->setPackaging('CA');
        $product2->setBaseProductPackaging('BO');
        $product2->setBaseProductUnit('LT');
        $product2->setBaseProductAmount(0.5);
        $product2->setBaseProductQuantity(234);
        $products[] = $product2;

        $product3 = new Product();
        $product3->setId('12345600003');
        $product3->setManufacturer('Drinks Corp.');
        $product3->setName('Beer, 6 * 0,5l');
        $product3->setPackaging('BX');
        $product3->setBaseProductPackaging('CN');
        $product3->setBaseProductUnit('LT');
        $product3->setBaseProductAmount(0.5);
        $product3->setBaseProductQuantity(345);
        $products[] = $product3;

        return $products;
    }

    private function getExpectedProductsFromB()
    {
        $products = [];

        $product1 = new Product();
        $product1->setId('12345600001');
        $product1->setManufacturer('Drinks Corp.');
        $product1->setName('Soda Drink, 12x 1L');
        $product1->setPackaging('CA');
        $product1->setBaseProductPackaging('BO');
        $product1->setBaseProductUnit('LT');
        $product1->setBaseProductAmount(1);
        $product1->setBaseProductQuantity(12);
        $products[] = $product1;

        $product2 = new Product();
        $product2->setId('12345600002');
        $product2->setManufacturer('Drinks Corp.');
        $product2->setName('Orange Drink, 20x 0.5L');
        $product2->setPackaging('CA');
        $product2->setBaseProductPackaging('BO');
        $product2->setBaseProductUnit('LT');
        $product2->setBaseProductAmount(0.5);
        $product2->setBaseProductQuantity(20);
        $products[] = $product2;

        $product3 = new Product();
        $product3->setId('12345600003');
        $product3->setManufacturer('Drinks Corp.');
        $product3->setName('Beer, 6x 0.5L');
        $product3->setPackaging('BX');
        $product3->setBaseProductPackaging('CN');
        $product3->setBaseProductUnit('LT');
        $product3->setBaseProductAmount(0.5);
        $product3->setBaseProductQuantity(6);
        $products[] = $product3;

        $product3 = new Product();
        $product3->setId('12345600004');
        $product3->setManufacturer('Drinks Corp.');
        $product3->setName('Champagne');
        $product3->setPackaging('BO');
        $product3->setBaseProductPackaging('BO');
        $product3->setBaseProductUnit('LT');
        $product3->setBaseProductAmount(0.75);
        $product3->setBaseProductQuantity(1);
        $products[] = $product3;

        return $products;
    }
}