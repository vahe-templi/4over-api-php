<?php

namespace FourOver\Entities;

use FourOver\Entities\BaseEntity;

class Product extends BaseEntity
{
    /**
     * @var string
     */
    private string $productUuid;

    /**
     * @var string
     */
    private string $productCode;

    /**
     * @var string
     */
    private string $productDescription;

    /**
     * @var CategoryList
     */
    private CategoryList $categories;

    /**
     * @param string $productUuid
     * @param string $productCode
     * @param string $productDescription
     */
    public function __construct(string $productUuid, string $productCode, string $productDescription)
    {
        $this->productUuid = $productUuid;
        $this->productCode = $productCode;
        $this->getProductDescription = $productDescription;
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->productCode;
    }

    /**
     * @return string
     */
    public function getProductDescription(): string
    {
        return $this->productDescription;
    }

    /**
     * @return string
     */
    public function getProductUuid(): string
    {
        return $this->productUuid;
    }

    /**
     * @return CategoryList
     */
    public function getCategories(): CategoryList
    {
        return $this->categories;
    }
}