<?php

namespace FourOver\Entities\Interfaces;

interface Jsonable {
    public function toJson() : string;
}