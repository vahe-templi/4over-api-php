<?php

require 'vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('PUBLIC_KEY', 'PRIVATE_KEY', 'SANDBOX'); // or 'LIVE' instead of 'SANDBOX'

/** 
 * Some products don't have turnaround option group so try a different index if it fails
 * @var \FourOver\Entities\Product\Product 
 * */
$product = $client->products->getAllProducts()[12];

/** @var \FourOver\Entities\Product\OptionGroupList */
$optionGroupList = $product->getProductOptionGroups();

/** @var \FourOver\Entities\Product\OptionGroupList */
$turnaroundOptionGroup = $optionGroupList->getTurnaroundOptionGroup();

/** @var \FourOver\Entities\Product\Option */
$turnaroundOption = $turnaroundOptionGroup->getOptions()[0];

/** @var string */
$runsizeUuid = $turnaroundOption->getRunsizeUuid();

/** @var string */
$colorspecUuid = $turnaroundOption->getColorspecUuid();

print_r(
    $colorspecUuid
);

// Result: 32d3c223-f82c-492b-b915-ba065a00862f