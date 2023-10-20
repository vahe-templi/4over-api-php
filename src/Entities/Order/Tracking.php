<?php

namespace FourOver\Entities\Order;

use FourOver\Entities\BaseEntity;

class Tracking extends BaseEntity
{
    private string $tracking;

    /**
     * @return string
     */
    public function getTrackingNumber() : string
    {
        return $this->tracking;
    }
}