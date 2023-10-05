<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseList;
use FourOver\Entities\Interfaces\Entity;

class CategoryList extends BaseList
{
    protected function getType() : Entity
    {
        return Category::class;
    }
}