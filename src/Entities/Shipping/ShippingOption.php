<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseEntity;

class ShippingOption extends BaseEntity
{
    private string $service_code;

    private string $service_name;

    private float $service_price;

    /**
     * @return string
     */
    public function getServiceName() : string
    {
        return $this->service_name;
    }

    /**
     * @return float
     */
    public function getServicePrice() : float
    {
        return $this->service_price;
    }
}