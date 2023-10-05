<?php

namespace FourOver\Services;

use FourOver\BaseApiClient;

abstract class AbstractService implements ServiceInterface
{
    /**
     * @var BaseApiClient
     */
    private BaseApiClient $apiClient;

    /**
     * @param BaseApiClient $apiClient
     */
    public function __construct(BaseApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $method GET, POST, DELETE, PUT, PATCH.
     * @param string $path ex. "/printproducts/productsfeed?product_uuid={uuid}"
     * @param array $params
     * 
     * @return \FourOver\Entities\Interfaces\Entity|FourOver\Entities\Interfaces\EntityList
     */
    protected function request(string $method, string $path, array $params = []) : mixed
    {
        return $this->getApiClient()->request($method, $path, $params);
    }

    protected function getApiClient() : BaseApiClient
    {
        return $this->apiClient;
    }
}