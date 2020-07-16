<?php

namespace kollex\Services;

class ProductFromBMapper implements ProductMapperInterface
{
    const BASE_PRODUCT_UNIT = 'LT';

    public function execute(array $productData): array
    {
        $product = [];

        $product['id'] = $productData['PRODUCT_IDENTIFIER'];
        $product['manufacturer'] = $productData['BRAND'];
        $product['name'] = $productData['NAME'];
        $product['packaging'] = $this->getPackaging($productData['PACKAGE']);
        $product['baseProductPackaging'] = $this->getBaseProductPackaging($productData['VESSEL']);
        $product['baseProductUnit'] = self::BASE_PRODUCT_UNIT;
        $product['baseProductAmount'] = $this->getBaseProductAmount($productData['LITERS_PER_BOTTLE']);
        $product['baseProductQuantity'] = (int)$productData['BOTTLE_AMOUNT'];

        return $product;
    }

    /**
     * @param string $packaging
     * @return string
     */
    private function getPackaging(string $packaging): string
    {
        switch (strtolower($packaging)) {
            case 'bottle':
                return 'BO';
            case 'box':
                return 'BX';
            case 'case':
                return 'CA';
            default:
                return '';
        }
    }

    private function getBaseProductPackaging($baseProductPackaging)
    {
        switch (strtolower($baseProductPackaging)) {
            case 'bottle':
                return 'BO';
            case 'can':
                return 'CN';
            default:
                return '';
        }
    }

    private function getBaseProductAmount($amount)
    {
        $fmt = numfmt_create( 'de_DE', \NumberFormatter::DECIMAL );
        return numfmt_parse($fmt, $amount);
    }
}