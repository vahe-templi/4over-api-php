<?php

namespace FourOver\Services;

use \JsonMapper;
use FourOver\BaseApiClient;
use FourOver\Entities\Interfaces\Entity;
use FourOver\Entities\Interfaces\EntityList;
use FourOver\Helpers\RemoveArrayElementsThatContainUrlAddresses;

abstract class AbstractService implements ServiceInterface
{
    /**
     * @var BaseApiClient
     */
    private BaseApiClient $apiClient;

    /**
     * https://github.com/cweiske/jsonmapper
     * @var JsonMapper
     */
    private JsonMapper $mapper;

    /**
     * To avoid problems with the JSON mapper some of the redundant keys from the API response are skipped.
     * 
     * @var array
     */
    private const API_RESPONSE_KEYS_TO_SKIP = [
        'entities', 'job'
    ];

    /**
     * @param BaseApiClient $apiClient
     */
    public function __construct(BaseApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        
        $this->mapper = new JsonMapper();
        $this->mapper->bIgnoreVisibility = true;
        $this->mapper->bEnforceMapType = false;
        $this->mapper->bRemoveUndefinedAttributes = true;
    }

    /**
     * @param string $method GET, POST, DELETE, PUT, PATCH.
     * @param string $path ex. "/printproducts/productsfeed?product_uuid={uuid}"
     * @param array $params
     * 
     * @return array array api response.
     */
    protected function request(string $method, string $path, array $params = []) : array
    {
        $response = $this->getApiClient()->request($method, $path, $params);

        return $this->prepareResponseForMapping($response);
    }

    /**
     * Prepares the API response to be mapped. Certain elements or keys need to be removed for the JSON mapper to work correctly.
     *
     * @param array $apiJsonResponse API json response to be cleaned.
     * @return array Clean and prepared API json response.
     */
    private function prepareResponseForMapping(array $apiJsonResponse) : array
    {
        // We need to remove elements that contain URL addresses because otherwise it will mess up the mapper.
        RemoveArrayElementsThatContainUrlAddresses::removeUrlsFromArray($apiJsonResponse);

        // Skip the first key of the response (ex. 'entities' or 'job') so it does not mess up up the json mapper
        $firstKey = key($apiJsonResponse);

        if(in_array($firstKey, self::API_RESPONSE_KEYS_TO_SKIP))
            $apiJsonResponse = $apiJsonResponse[$firstKey];

        return $apiJsonResponse;
    }

    /**
     * @return BaseApiClient
     */
    protected function getApiClient() : BaseApiClient
    {
        return $this->apiClient;
    }

    /**
     * @return JsonMapper
     */
    private function getMapper() : JsonMapper
    {
        return $this->mapper;
    }

    /**
     * @param string $entityPath ex. 'FourOver\Entities\Product\Category' or Category::class
     * @throws \TypeError
     * 
     * @return void
     */
    private static function throwExceptionIfObjectIsNotValidEntity(string $entityPath) : void
    {
        if (!class_exists($entityPath) || !in_array(Entity::class, class_implements($entityPath)) && !in_array(EntityList::class, class_implements($entityPath))) {
            throw new \TypeError("The provided class $entityPath does not implement either Entity or EntityList interfaces.");
        }
    }

    /**
     * @param array $apiJsonResponse
     * @param string $entityPath ex. 'FourOver\Entities\Product\Category' or Category::class or CategoryList::class
     * @param string|null $entityListPath
     * 
     * @return Entity|EntityList
     */
    protected function mapResponseToEntity(array $apiJsonResponse, string $entityPath, string $entityListPath = null)
    {
        // @TODO Check $entityPath and $entityListPath seperately
        self::throwExceptionIfObjectIsNotValidEntity($entityPath);

        // In case of some calls API returns multiple elements (ex. product feed) and the very first 
        // element in the response will be 'entities' which contains actual data. In such case we want the mapper to use
        // mapArray() which will return an object that implements EntityList interface.
        // Some API calls return a single entity (ex. shipping quote) and in such case we want to use map() instead of mapArray()
        // Refer to https://github.com/cweiske/jsonmapper#basic-usage
        if($entityListPath === null)
            return $this->getMapper()->map($apiJsonResponse, $entityPath);

        // @TODO ??? Add page pagination for EntityList
        /**
         * @var Entity|EntityList
         */
        return $this->getMapper()->mapArray($apiJsonResponse, new $entityListPath(), $entityPath);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $params http client parameters (POST data, url parameters, headers etc.) Refer to guzzle http docs
     * @param string $entity
     * @param string|null $entityPath
     * 
     * @return Entity|EntityList
     */
    protected function getResource(
        string $method, 
        string $path, 
        array $params = [], 
        string $entityPath, 
        string $entityListPath = null
    ) {
        self::throwExceptionIfObjectIsNotValidEntity($entityPath);

        /** @var array */
        $jsonApiResponse= $this->request($method, $path, $params);

        return $this->mapResponseToEntity(
            $jsonApiResponse, $entityPath, $entityListPath
        );
    }
}