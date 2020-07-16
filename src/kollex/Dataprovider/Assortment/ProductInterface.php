<?php

namespace kollex\Dataprovider\Assortment;

interface ProductInterface
{
    public function setId(string $id);

    public function getId(): string;

    public function setManufacturer(string $manufacturer);

    public function getManufacturer(): string;

    public function setName(string $name);

    public function getName(): string;

    public function setPackaging(string $packaging);

    public function getPackaging(): string;

    public function setBaseProductPackaging(string $baseProductPackaging);

    public function getBaseProductPackaging(): string;

    public function setBaseProductUnit(string $baseProductUnit);

    public function getBaseProductUnit(): string;

    public function setBaseProductAmount(float $baseProductAmount);

    public function getBaseProductAmount(): float;

    public function setBaseProductQuantity(int $baseProductQuantity);

    public function getBaseProductQuantity(): int;
}
