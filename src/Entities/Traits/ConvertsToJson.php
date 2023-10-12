<?php

namespace FourOver\Entities\Traits;

use FourOver\Entities\Interfaces\Arrayable;

trait ConvertsToJson
{
    /**
     * Returns the entire entity (EntityList as well) as a JSON
     *
     * @return string
     */
    public function toJson() : string
    {
        if(!$this instanceof Arrayable)
            throw new \Exception('The parent class must implement Arrayable interface.');
        
        return json_encode($this->toArray());
    }
}