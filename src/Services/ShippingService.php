<?php

namespace FourOver\Services;

use FourOver\Entities\Shipping\ShippingQuote;

class ShippingService extends AbstractService
{
    /**
     * https://api-users.4over.com/?page_id=113
     *
     * @return ShippingQuote
     */
    public function getShippingQuote(
        string $productUuid,
        string $runsizeUuid,
        string $turnaroundUuid,
        string $colorspecUuid,
        string $address,
        string $address2,
        string $city,
        string $state,
        string $country,
        string $zipcode,
        int $sets
    ) : ShippingQuote {
        $postBodyData = json_encode([
            'product_info' => [
                'product_uuid' => $productUuid,
                'runsize_uuid' => $runsizeUuid,
                'turnaround_uuid' => $turnaroundUuid,
                'colorspec_uuid' => $colorspecUuid,
                'sets' => $sets,
                'option_uuids' => []
            ],
            'shipping_address' => [
                'address' => $address,
                'address2' => $address2,
                'city' => $city,
                'state' => $state,
                'country' => $country,
                'zipcode' => $zipcode,
            ]
        ]);

        return $this->getResource(
            'POST', 
            '/shippingquote', 
            ['body' => $postBodyData], 
            ShippingQuote::class
        );
    }
}