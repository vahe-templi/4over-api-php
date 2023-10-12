<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseList;

class FacilityList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return Facility::class;
    }
}