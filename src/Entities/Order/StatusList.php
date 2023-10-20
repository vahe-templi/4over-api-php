<?php

namespace FourOver\Entities\Order;

use FourOver\Entities\BaseList;

class StatusList extends BaseList
{
    /**
     * @return string
     */
    public static function getType() : string
    {
        return Status::class;
    }

    /**
     * Get latest status update.
     *
     * @return Status
     */
    public function getLatestStatus() : Status
    {
        return $this->getItems()[0];
    }
}