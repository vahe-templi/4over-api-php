<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class Category extends BaseEntity 
{
    /**
     * @var string
     */
    private string $category_uuid;

    /**
     * @var string
     */
    private string $category_name;

    /**
     * @var string
     */
    private string $category_description;

    public function __construct(string $categoryUuid, string $categoryName, string $categoryDescription)
    {
        $this->category_uuid = $categoryUuid;
        $this->category_name = $categoryName;
        $this->category_description = $categoryDescription;
    }

    /**
     * Get the value of categoryDescription
     */
    public function getCategoryDescription(): string
    {
        return $this->category_description;
    }

    /**
     * Get the value of categoryName
     */
    public function getCategoryName(): string
    {
        return $this->category_name;
    }

    /**
     * Get the value of categoryUuid
     */
    public function getCategoryUuid(): string
    {
        return $this->category_uuid;
    }
}