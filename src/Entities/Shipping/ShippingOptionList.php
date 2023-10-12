<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseList;

class ShippingOptionList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return ShippingOption::class;
    }
}