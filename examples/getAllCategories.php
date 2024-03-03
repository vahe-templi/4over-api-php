<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('', '', 'SANDBOX');

$categories = $client->categories->getAllCategories();

print_r($categories);