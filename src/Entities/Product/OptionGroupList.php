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
        return $this->find('product_option_group_name', 'Turn-Around');
    }

    /**
     * @return OptionGroup
     */
    public function getRunsizeOptionGroup() : OptionGroup
    {
        return $this->find('product_option_group_name', 'Runsize');
    }
}