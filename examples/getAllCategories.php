<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('PUBLIC_KEY', 'PRIVATE_KEY', 'SANDBOX');

$categories = $client->categories->getAllCategories();

print_r($categories);