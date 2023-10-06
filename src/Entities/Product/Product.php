<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class Product extends BaseEntity
{
    /**
     * @var string
     */
    private string $product_uuid;

    /**
     * @var string
     */
    private string $product_code;

    /**
     * @var string
     */
    private string $product_description;

    /**
     * @var CategoryList[Category]
     */
    private CategoryList $categories;

    /**
     * @var OptionGroupList[OptionGroup]
     */
    private OptionGroupList $product_option_groups;

    /**
     * @param string $productUuid
     * @param string $productCode
     * @param string $productDescription
     * @param CategoryList $categoryList
     */
    public function __construct(string $productUuid, string $productCode, string $productDescription, CategoryList $categories)
    {
        $this->product_uuid = $productUuid;
        $this->product_code = $productCode;
        $this->product_description = $productDescription;
        $this->categories = $categories;
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->product_code;
    }

    /**
     * @return string
     */
    public function getProductDescription(): string
    {
        return $this->product_description;
    }

    /**
     * @return string
     */
    public function getProductUuid(): string
    {
        return $this->product_uuid;
    }

    /**
     * @return CategoryList[Category]
     */
    public function getCategories(): CategoryList
    {
        return $this->categories;
    }

    /**
     * @return OptionGroupList[OptionGroup]
     */
    public function getProductOptionGroups(): OptionGroupList
    {
        return $this->product_option_groups;
    }
}