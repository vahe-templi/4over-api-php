<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class Category extends BaseEntity 
{
    /**
     * Unfortunately, 4over API is not consistent and sometimes it returns same entities with different key names in certain API calls
     * 
     * @var array
     */
    protected array $KEY_NAMES = [
        '_uuid' => [
            'category_uuid',
            'id'
        ],
        '_name' => [
            'category_name',
            'name'
        ],
        '_description' => [
            'category_description',
            'description'
        ]
    ];

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

    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $description;

    /**
     * Get the value of categoryDescription
     */
    public function getCategoryDescription(): string
    {
        return $this->_description;
    }

    /**
     * Get the value of categoryName
     */
    public function getCategoryName(): string
    {
        return $this->_name;
    }

    /**
     * Get the value of categoryUuid
     */
    public function getCategoryUuid(): string
    {
        return $this->_uuid;
    }
}