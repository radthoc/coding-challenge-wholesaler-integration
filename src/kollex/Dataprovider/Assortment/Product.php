<?php

namespace kollex\Dataprovider\Assortment;

class Product implements ProductInterface
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $manufacturer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $packaging;

    /**
     * @var string
     */
    private $baseProductPackaging;

    /**
     * @var string
     */
    private $baseProductUnit;

    /**
     * @var float
     */
    private $baseProductAmount;

    /**
     * @var int
     */
    private $baseProductQuantity;

    private $validationRules = [
        'id' => [
            'required' => true,
            'type' => 'string',
        ],
        'manufacturer' => [
            'required' => true,
            'type' => 'string',
        ],
        'name' => [
            'required' => true,
            'type' => 'string',
        ],
        'packaging' => [
            'required' => true,
            'type' => 'string',
            'enum' => ['CA', 'BX', 'BO'],
        ],
        'baseProductPackaging' => [
            'required' => true,
            'type' => 'string',
            'enum' => ['BO', 'CN'],
        ],
        'baseProductUnit' => [
            'required' => true,
            'type' => 'string',
            'enum' => ['LT', 'GR'],
        ],
        'baseProductAmount' => [
            'required' => true,
            'type' => 'float',
        ],
        'baseProductQuantity' => [
            'required' => true,
            'type' => 'int',
        ],
    ];

    private $validationFilter = [
        'string' => [
            'filter' => 'FILTER_VALIDATE_REGEXP',
            'params' => [
                'options' => ['regexp' => "/^[a-zA-Z0-9,.* ]*$/"]
            ]
        ],
        'int' => [
            'filter' => 'FILTER_VALIDATE_INT',
        ],
        'float' => [
            'filter' => 'FILTER_VALIDATE_FLOAT',
        ]
    ];

    public function setId(string $id)
    {
        if (!$this->isValid('id', $id)) {
            throw new \Exception('Invalid id');
        }

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setManufacturer(string $manufacturer)
    {
        if (!$this->isValid('manufacturer', $manufacturer)) {
            throw new \Exception('Invalid manufacturer');
        }

        $this->manufacturer = $manufacturer;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setName(string $name)
    {
        if (!$this->isValid('name', $name)) {
            throw new \Exception('Invalid name');
        }

        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPackaging(string $packaging)
    {
        if (!$this->isValid('packaging', $packaging)) {
            throw new \Exception('Invalid packaging');
        }

        $this->packaging = $packaging;
    }

    public function getPackaging(): string
    {
        return $this->packaging;
    }

    public function setBaseProductPackaging(string $baseProductPackaging)
    {
        if (!$this->isValid('baseProductPackaging', $baseProductPackaging)) {
            throw new \Exception('Invalid base product packaging');
        }

        $this->baseProductPackaging = $baseProductPackaging;
    }

    public function getBaseProductPackaging(): string
    {
        return $this->baseProductPackaging;
    }

    public function setBaseProductUnit(string $baseProductUnit)
    {
        if (!$this->isValid('baseProductUnit', $baseProductUnit)) {
            throw new \Exception('Invalid base product unit');
        }

        $this->baseProductUnit = $baseProductUnit;
    }

    public function getBaseProductUnit(): string
    {
        return $this->baseProductUnit;
    }

    public function setBaseProductAmount(float $baseProductAmount)
    {
        if (!$this->isValid('baseProductAmount', $baseProductAmount)) {
            throw new \Exception('Invalid base product amount');
        }

        $this->baseProductAmount = $baseProductAmount;
    }

    public function getBaseProductAmount(): float
    {
        return $this->baseProductAmount;
    }

    public function setBaseProductQuantity(int $baseProductQuantity)
    {
        if (!$this->isValid('baseProductQuantity', $baseProductQuantity)) {
            throw new \Exception('Invalid base product quantity');
        }

        $this->baseProductQuantity = $baseProductQuantity;
    }

    public function getBaseProductQuantity(): int
    {
        return $this->baseProductQuantity;
    }

    private function isValid(string $field, $value): bool
    {
        $required = false;

        if (isset($this->validationRules[$field]['required']) &&
            $this->validationRules[$field]['required']
        ) {
            if (!$value) {
                return false;
            }

            $required = true;
        }

        if ($required || $value) {
            $options = isset($this->validationFilter[$this->validationRules[$field]['type']]['params']) ?
                $this->validationFilter[$this->validationRules[$field]['type']]['params'] :
                [];

            if (filter_var(
                    $value,
                    constant($this->validationFilter[$this->validationRules[$field]['type']]['filter']),
                    $options
                ) === false
            ) {
                return false;
            }

            if (isset($this->validationRules[$field]['enum']) &&
                !in_array($value, $this->validationRules[$field]['enum'])
            ) {echo  ' * no enum';
                return false;
            }
        }

        return true;
    }
}