<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseEntity;

class OptionGroup extends BaseEntity
{
    private string $product_option_group_uuid;

    public string $product_option_group_name;

    /**
     * @var OptionList[Option]
     */
    private OptionList $options;


    /**
     * @return OptionList[Option]
     */
    public function getOptions() : OptionList
    {
        return $this->options;
    }
}