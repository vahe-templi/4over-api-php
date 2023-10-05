<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class Category extends BaseEntity 
{
    private string $categoryUuid;

    private string $categoryName;

    private string $categoryDescription;

    public function __construct(string $categoryUuid, string $categoryName, string $categoryDescription)
    {
        $this->categoryUuid = $categoryUuid;
        $this->categoryName = $categoryName;
        $this->categoryDescription = $categoryDescription;
    }

    /**
     * Get the value of categoryDescription
     */
    public function getCategoryDescription(): string
    {
        return $this->categoryDescription;
    }

    /**
     * Get the value of categoryName
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * Get the value of categoryUuid
     */
    public function getCategoryUuid(): string
    {
        return $this->categoryUuid;
    }
}