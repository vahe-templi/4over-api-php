<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseEntity;

class Facility extends BaseEntity
{
    private Address $address;

    /**
    * @var ShippingOptionList[ShippingOption]
    */
    private ShippingOptionList $shipping_options;
}