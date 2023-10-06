<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseList;

class OptionPriceList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return OptionPrice::class;
    }
}