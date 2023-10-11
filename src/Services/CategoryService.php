<?php

namespace FourOver\Services;

use FourOver\Entities\Product\Category;
use FourOver\Entities\Product\CategoryList;

class CategoryService extends AbstractService
{
    /**
     * https://api-users.4over.com/?page_id=90
     *
     * @return CategoryList
     */
    public function getAllCategories()
    {
        return $this->getResource('GET', '/printproducts/categories', [], Category::class, CategoryList::class);
    }
}