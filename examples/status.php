<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('PUBLIC_KEY', 'PRIVATE_KEY', 'SANDBOX');

/** 
 * See createOrder.php to learn how to create an order and retrieve job_uuid.
 * */
$job_uuid = '';

$statusList = $client->orders->getOrderStatus($job_uuid);

print_r(
    $statusList->getLatestStatus()
);