<?php

namespace FourOver\Entities\Product;

use FourOver\Entities\BaseList;

class OptionGroupList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return OptionGroup::class;
    }

    /**
     * @return OptionGroup
     */
    public function getTurnaroundOptionGroup() : OptionGroup
    {
        // Their API is very inconsistent and in one response the option group is "Turn-Around" and in the other it's "Turn Around Time"
        $possibilities = [
            $this->find('product_option_group_name', 'Turn-Around'),
            $this->find('product_option_group_name', 'Turn Around Time')
        ];

        // Return first non-null value from $possibilities
        return current(array_filter($possibilities));
    }

    /**
     * @return OptionGroup
     */
    public function getRunsizeOptionGroup() : OptionGroup
    {
        return $this->find('product_option_group_name', 'Runsize');
    }
}