<?php

namespace FourOver\Entities;

use FourOver\Entities\Interfaces\Entity;
use FourOver\Entities\Interfaces\Arrayable;

abstract class BaseEntity implements Entity
{
     /**
     * Unfortunately, 4over API is not consistent and sometimes it returns same entities with different key names in certain API calls
     * 
     * @var array
     */
    protected array $KEY_NAMES;

    /**
     * Some keys might differ in different API calls, and we want to scan the response for all possible names
     * 
     * @return mixed|null
     */
    public function __get(string $property)
    {
        if(isset($this->{$property}) and $this->{$property} !== null)
            return $this->{$property};

        /**
         * @var array
         */
        $possibleKeys = \array_key_exists($property, $this->getKeyNames()) ? $this->getKeyNames()[$property] : null;

        if($possibleKeys === null)
            throw new \Exception("$property not found in KEY_NAMES map");

        $actualProperty = $this->findProperty($possibleKeys);

        return $actualProperty !== null ? $this->getPrivateProperty($actualProperty) : null;
    }

    private function getReflection()
    {
        return new \ReflectionClass($this);
    }

    /**
     * Some properties are set private, but we still want to retrieve them so we use this function
     * @param string $property Class property name
     * 
     * @return mixed|null
     */
    private function getPrivateProperty(string $property)
    {
        $property = $this->getReflection()->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($this);
    }

    /**
     * Checks if a property exists in the child (even if it's private)
     * @param array $map See $KEY_NAMES
     * 
     * @return string|null
     */
    private function findProperty(array $map) {
        $classProperties = $this->getReflection()->getProperties();
    
        foreach ($map as $propertyName) {
            foreach ($classProperties as $property) {
                $property->setAccessible(true);

                if ($property->getName() === $propertyName) {
                    return $propertyName;
                }
            }
        }
    
        return null; // None of the property names exist
    }

    /**
     * @return array
     */
    private function getKeyNames()
    {
        return $this->KEY_NAMES;
    }

    /**
     * Converts entity and all of its properties to an array
     *
     * @return array
     */
    public function toArray() : array {
        $array = [];
        $reflection = $this->getReflection();
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();

            if(!$property->isInitialized($this))
                continue;

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