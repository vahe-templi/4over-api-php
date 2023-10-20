<?php

namespace FourOver\Entities\Order;

use FourOver\Entities\BaseEntity;

class Status extends BaseEntity
{
    private string $status_code_uuid;

    private string $status;
    
    private string $date_set;

    /**
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDateSet() : string
    {
        return $this->date_set;
    }
}