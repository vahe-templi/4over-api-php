<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseList;

class OptionGroupList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return OptionGroup::class;
    }
}