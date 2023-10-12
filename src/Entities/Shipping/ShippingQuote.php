<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseEntity;

class ShippingQuote extends BaseEntity
{
    /**
     * @var ProductInfo
     */
    private ProductInfo $product_info;

    /**
     * @var Address
     */
    private Address $ship_to;

    /**
     * @var FacilityList[Facility]
     */
    private FacilityList $facilities;
}