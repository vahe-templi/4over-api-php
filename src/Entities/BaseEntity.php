<?php

namespace FourOver\Entities;

use FourOver\Entities\Interfaces\Entity;

abstract class BaseEntity implements Entity
{
    public function toArray() {
        $array = [];
        $reflection = new ReflectionClass($this);

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