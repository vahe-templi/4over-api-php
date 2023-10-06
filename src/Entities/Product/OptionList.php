<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseList;

class OptionList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return Option::class;
    }
}