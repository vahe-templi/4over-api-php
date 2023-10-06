<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseList;

class ProductList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return Product::class;
    }
}