<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class Option extends BaseEntity
{
    private string $option_uuid;

    private string $option_name;

    /**
     * @var string|null
     */
    private $option_description = null;

    private string $runsize_uuid;

    private int $runsize;

    private string $colorspec_uuid;

    private string $colorspec;

    /**
     * @var OptionPriceList[OptionPrice]
     */
    private OptionPriceList $option_prices_list;
}