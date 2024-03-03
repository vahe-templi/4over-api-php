<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('PUBLIC_KEY', 'PRIVATE_KEY', 'SANDBOX');

/** 
 * Some products don't have turnaround option group so try a different index if it fails
 * @var \FourOver\Entities\Product\Product 
 * */
$product = $client->products->getAllProducts()[12];

/** @var string */
$productUuid = $product->getProductUuid();

$product = $client->products->getProduct($productUuid);
$optionGroupList = $product->getProductOptionGroups();

/** @var \FourOver\Entities\Product\OptionGroup */
$runsizeOptions = $optionGroupList->getRunsizeOptionGroup()->getOptions();
$colorspecOptions = $optionGroupList->getColorspecOptionGroup()->getOptions();
$turnaroundOptions = $optionGroupList->getTurnaroundOptionGroup()->getOptions();

$runsizeUuid = $turnaroundOptions[0]->getRunsizeUuid();
$colorspecUuid = $turnaroundOptions[0]->getColorspecUuid();
$turnaroundUuid = $turnaroundOptions[0]->getOptionUuid();


$address  = '4301 Washington Road.';
$address2 = '';
$city = 'Evans';
$state = 'GA';
$country  = 'US';
$zipcode  = '30809';
$sets = 1;

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
    $sets,
    $optionalUuids = []
);

$shippingOption = $shippingQuote->getShippingOptions()[0];

$shippingServiceName = $shippingOption->getServiceName();
$shippingServiceCode = $shippingOption->getServiceCode();

$file = $client->files->createFile('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf')->toArray();
$fileUuidFront = $file['files'][0]['file_uuid'];

$file = $client->files->createFile('https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf')->toArray();
$fileUuidBack = $file['files'][0]['file_uuid'];

$files = [
    "set_001" => [
        "job_name" => "job001-001",
        "files" => [
            "fr" => $fileUuidFront,
            "bk" => $fileUuidBack
        ]
    ]

];

$order_id = 'test001';
$coupon_code = null;
$skip_conformation = true;
$optionUuids = [];
$dropship = true;
$ship_to_company = null;
$ship_to_address  = '4301 Washington Road.';
$ship_to_address2 = '';
$ship_to_city = 'Evans';
$ship_to_state = 'GA';
$ship_to_country  = 'US';
$ship_to_zipcode  = '30809';
$ship_to_firstname = 'John';
$ship_to_lastname = 'Smith';
$ship_to_email = 'smith@gmail.com';
$ship_to_phone = '7362647943';
$shipping_method = $shippingServiceName;
$shipping_code = $shippingServiceCode;
$ship_from_company = 'GoodFood';
$ship_from_firstname = 'Jackson';
$ship_from_lastname = 'Johnson';
$ship_from_email = 'johnson@gmail.com';
$ship_from_phone = '510454901';
$ship_from_address = '4301 Washington Road.';
$ship_from_address2 = '';
$ship_from_city = 'Evans';
$ship_from_state = 'GA';
$ship_from_zipcode = '30809';
$ship_from_country = 'US';

/** @var \FourOver\Entities\Order\OrderCreatedResponse */
$orderCreatedResponse = $client->orders->createOrder(
    $order_id,
    $coupon_code,
    $skip_conformation,
    $sets,
    $productUuid,
    $runsizeUuid,
    $turnaroundUuid,
    $colorspecUuid ,
    $optionUuids,
    $dropship,
    $files, // see their docs for examples. @todo objects instead of raw arrays
    $ship_to_company,
    $ship_to_firstname,
    $ship_to_lastname,
    $ship_to_email,
    $ship_to_phone,
    $ship_to_address,
    $ship_to_address2,
    $ship_to_city,
    $ship_to_state,
    $ship_to_zipcode,
    $ship_to_country,
    $ship_from_company,
    $ship_from_firstname,
    $ship_from_lastname,
    $ship_from_email,
    $ship_from_phone,
    $ship_from_address,
    $ship_from_address2,
    $ship_from_city,
    $ship_from_state,
    $ship_from_zipcode,
    $ship_from_country,
    $shipping_method,
    $shipping_code,
);

print_r(
    $orderCreatedResponse
);

// $orderCreatedResponse->getFirstJobUuid() to retrieve the job UUID.