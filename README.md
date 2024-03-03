# 4over-api-php

## 4over API docs

[https://api-users.4over.com/](https://api-users.4over.com/)

## Installation

```
composer require arturnawrot/4over-api-client
```

## Example Usage
```php
<?php

require '../vendor/autoload.php';

use FourOver\FourOverApiClient;

$client = new FourOverApiClient('PUBLIC_KEY', 'PRIVATE_KEY', 'SANDBOX');

$categories = $client->categories->getAllCategories();

print_r($categories);
```

### See other example usage in:
```examples/createOrder.php```,

```examples/getShippingQuote.php```,

```examples/status.php```,

```examples/tracking.php```,

## Contact Us

For professional assistance with web application development utilizing the 4over API, please contact us at support@legacysoftwares.com or call us at (877) 372-5313.

[legacysoftwares.com](https://legacysoftwares.com/)

## Licence
The MIT License (MIT). Please see [License File](https://github.com/arturnawrot/4over-api-php/blob/main/LICENSE.md) for more information.
