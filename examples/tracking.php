<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('', '', 'SANDBOX');

/** 
 * See createOrder.php to learn how to create an order and retrieve job_uuid.
 * */
$job_uuid = '';

$tracking = $client->orders->getTrackingNumber($job_uuid);

/** 
 * If the 'tracking' property is empty, then it is possible that they did not process the order properly.
 * First check the status (see status.php).
 * */

print_r(
    $tracking
);