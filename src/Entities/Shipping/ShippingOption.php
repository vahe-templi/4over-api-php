<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseEntity;

class ShippingOption extends BaseEntity
{
    private string $service_code;

    private string $service_name;

    private float $service_price;
}