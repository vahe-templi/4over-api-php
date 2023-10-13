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

    /**
     * @return ShippingOptionList
     */
    public function getShippingOptions() : ShippingOptionList
    {
        // I'm assuming they only pass just 1 closest facility. Probably there's no point in passing more than 1 but I could be wrong.
        return $this->getFacilities()[0]->getShippingOptions();
    }

    /**
     * @return FacilityList
     */
    public function getFacilities() : FacilityList
    {
        return $this->facilities;
    }
}