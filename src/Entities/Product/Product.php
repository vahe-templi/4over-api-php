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
     * @return CategoryList[Category]|string
     */
    public function getCategories()
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