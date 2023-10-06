<?php

namespace FourOver\Entities;

use FourOver\Entities\Interfaces\Entity;
use FourOver\Entities\Interfaces\EntityList;

abstract class BaseList extends \ArrayObject implements EntityList {

    /**
     * Calls \ArrayObject's constructor to make it work like an array.
     *
     * @param Entity ...$entities
     */
    public function __construct(Entity ...$entities) {
        // @TODO need to do it in a different way since you can't call an abstract method getType() in throwExceptionIfNotTypeSafe()
        // $this->throwExceptionIfNotTypeSafe(...$entities);

        parent::__construct($entities);
    }

    /**
     * Make sure that all elements are of the same type so the list is type safe just like all lists in C#
     *
     * @param Entity ...$entities
     * @return void
     */
    private static function throwExceptionIfNotTypeSafe(Entity ...$entities)
    {
        $type = self::getType();

        foreach($entities as $item) 
        {
            if(!$item instanceof $type)
                throw new \Exception("$item is not $type");

            if(!$item instanceof Entity)
                throw new \Exception("$item does not implement FourOver\Entities\Interfaces\Entity interface.");
        }
    }

    /**
     * Converts list and everything inside it to an array
     *
     * @return array
     */
    public function toArray() : array {
        $result = [];
        $entities = $this->getArrayCopy();
        foreach ($entities as $item) {
            $result[] = $item->toArray();
        }
        return $result;
    }

    /**
     * Get entire entity containing specific value.
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return mixed
     */
    protected function find(string $key, $value)
    {
        $entities = $this->getArrayCopy();

        foreach($entities as $entity)
        {
            if($entity->{$key} === $value)
                return $entity;
        }

        return null;
    }
    /**
     * Child class will need to specify its type so the list will be type safe.
     *
     * @return string
     */
    abstract public static function getType() : string;
}