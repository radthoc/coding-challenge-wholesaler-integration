<?php

namespace kollex\Services;

class ProductFromAMapper implements ProductMapperInterface
{
    public function execute(array $productData): array
    {
        $product = [];

        $product['id'] = $productData[0];
        $product['manufacturer'] = $productData[2];
        $product['name'] = $productData[3];
        $product['packaging'] = $this->getPackaging($productData[5]);
        $product['baseProductPackaging'] = $this->getBaseProductPackaging($productData[7]);
        $product['baseProductUnit'] = $this->getUnit($productData[8]);
        $product['baseProductAmount'] = (float)$productData[8];
        $product['baseProductQuantity'] = (int)$productData[9];

        return $product;
    }

    /**
     * @param string $unitInfo
     * @return string
     */
    private function getUnit(string $unitInfo): string
    {
        $unit = substr($unitInfo, -1);

        switch (strtolower($unit)) {
            case 'l':
                return 'LT';
            case 'g':
                return 'GR';
            default:
                return '';
        }
    }

    /**
     * @param string $packagingInfo
     * @return string
     */
    private function getPackaging(string $packagingInfo)
    {
        $packaging = explode(' ', $packagingInfo)[0];

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
}