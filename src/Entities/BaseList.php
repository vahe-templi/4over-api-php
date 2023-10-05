<?php

namespace FourOver\Entities;

use FourOver\Entities\Interfaces\Entity;
use FourOver\Entities\Interfaces\EntityList;

abstract class BaseList implements EntityList {
    protected $items = [];

    public function __construct(array $items) {
        foreach($items as $item) {
            $type = $this->getType();

            if(!$item instanceof $type)
                throw new \Exception("$item is not $type");

            if(!$item instanceof Entity)
                throw new \Exception("$item does not implement FourOver\Entities\Interfaces\Entity interface.");
        }

        $this->items = $items;
    }

    public function toArray() {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = $item->toArray();
        }
        return $result;
    }

    abstract protected function getType() : Entity;
}