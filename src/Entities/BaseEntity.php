<?php

namespace FourOver\Entities;

use FourOver\Entities\Interfaces\Entity;
use FourOver\Entities\Interfaces\Arrayable;

abstract class BaseEntity implements Entity
{
    /**
     * Converts entity and all of its properties to an array
     *
     * @return array
     */
    public function toArray() : array {
        $array = [];
        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($this);

            if($propertyValue instanceof Arrayable) {
                $array[$propertyName] = $propertyValue->toArray();
            } else {
                $array[$propertyName] = $propertyValue;
            }
        }

        return $array;
    }
}