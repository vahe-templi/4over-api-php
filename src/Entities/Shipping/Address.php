<?php

namespace FourOver\Entities\Shipping;

use FourOver\Entities\BaseEntity;

class Address extends BaseEntity
{
    private string $address;

    private string $address2;

    private string $city;

    private string $state;

    private string $country;

    private int $zipcode;

    private int $is_residential;
}