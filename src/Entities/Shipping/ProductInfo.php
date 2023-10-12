<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseEntity;

class ProductInfo extends BaseEntity
{
    private float $box_weight;

    private string $product_code;

    private int $box_count;

    private string $product_uuid;

    private $runsize_uuid;

    private array $option_uuids;

    public function getBoxWeight()
    {
        return $this->box_weight;
    }
}