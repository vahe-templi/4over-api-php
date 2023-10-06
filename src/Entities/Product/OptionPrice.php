<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class OptionPrice extends BaseEntity
{
    private string $option_uuid;

    private string $option_name;

    private string $option_description;

    private string $option_price_uuid;

    private float $price;

    private string $runsize_uuid;

    private int $runsize;

    private string $colorspec_uuid;

    private string $colorspec_name;
}