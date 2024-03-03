<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('', '', 'SANDBOX');

/** 
 * Some products don't have turnaround option group so try a different index if it fails
 * @var \FourOver\Entities\Product\Product 
 * */
$product = $client->products->getAllProducts()[12];

/** @var string */
$productUuid = $product->getProductUuid();

$product = $client->products->getProduct($productUuid);

/** @var \FourOver\Entities\Product\OptionGroupList */
$optionGroupList = $product->getProductOptionGroups();

/** @var \FourOver\Entities\Product\OptionGroupList */
$turnaroundOptionGroup = $optionGroupList->getTurnaroundOptionGroup();

/** @var \FourOver\Entities\Product\Option */
$turnaroundOption = $turnaroundOptionGroup->getOptions()[0];

/** @var string */
$colorspecUuid = $turnaroundOption->getColorspecUuid();

/** @var string */
$turnaroundUuid = $turnaroundOption->getOptionUuid();

/** @var string */
$runsizeUuid = $turnaroundOption->getRunsizeUuid();

$address  = '4301 Washington Road.';
$address2 = '';
$city = 'Evans';
$state = 'GA';
$country  = 'US';
$zipcode  = '30809';
$sets = 20;

/** @var \FourOver\Entities\Shipping\ShippingQuote */
$shippingQuote = $client->shipping->getShippingQuote(
    $productUuid,
    $runsizeUuid,
    $turnaroundUuid,
    $colorspecUuid,
    $address,
    $address2,
    $city,
    $state,
    $country,
    $zipcode,
    $sets
);

print_r(
    $shippingQuote
);