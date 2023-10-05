<?php

namespace FourOver;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class BaseApiClient {

    /**
     * @var string BASE_URL
     */
    const BASE_URL = 'https://api.4over.com';

    /**
     * @var array Valid HTTP methods that 4over API supports
     */
    const VALID_HTTP_METHODS = ['GET', 'DELETE', 'POST', 'PUT', 'PATCH'];

    /**
     * @var string Public key
     */
    private string $publicKey;

    /**
     * @var string Private key
     */
    private string $privateKey;
    
    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    protected \Psr\Http\Client\ClientInterface $httpClient;

    /**
     * @param string $publicKey
     * @param string $privateKey
     * @param \Psr\Http\Client\ClientInterface $httpClient Any HTTP client which is compatible with PSR
     */
    public function __construct(string $publicKey, string $privateKey, \Psr\Http\Client\ClientInterface $httpClient = null)
    {
        $this->publicKey = $publicKey;
        
        $this->privateKey = $privateKey;

        if($httpClient == null) {
            $this->httpClient = new Client();
        } else {
            $this->httpClient = $httpClient;
        }
    }

    /**
     * @param string $method GET, POST, DELETE, PUT, PATCH.
     * @param string $path ex. "/printproducts/productsfeed?product_uuid={uuid}"
     * @param array $params
     * 
     * @throws \Exception
     * 
     * @return array JSON converted to array
     */
    public function request(string $method, string $path, array $params = []) : array
    {
        $request = $this->prepareRequest($method, self::prepareUri($path));

        $response = $this->getHttpClient()->send($request, $params);

        if($response->getStatusCode() !== 200)
            throw new \Exception('Something went wrong...'); 

        return json_decode($response->getBody(), true);
    }

    /**
     * @param string $path ex. "/printproducts/productsfeed?product_uuid={uuid}"
     * 
     * @return string full URI ex. "https://api.4over.com/printproducts/productsfeed?product_uuid={uuid}"
     */
    private static function prepareUri(string $path) : string
    {
        return self::BASE_URL . $path;
    }

    /**
     * 4over API supports only certain HTTP methods. If given method is not supported then it's better
     * to throw an exception rather than continuing sending an API call that will fail anyways
     * 
     * @param string $method GET, POST, DELETE, PUT, PATCH etc.
     * @throws \InvalidArgumentException
     * 
     * @return void
     */
    private static function throwExceptionIfMethodNotAllowed(string $method) : void
    {
        if(!in_array($method, self::VALID_HTTP_METHODS))
            throw new \InvalidArgumentException("Method '$method' is not supported.");
    }

    /**
     * According to the 4over API docs (https://api-users.4over.com/?page_id=44)
     * GET and DELETE requests need to have the API credentials in the URL query
     * and POST, PUT, PATCH requests need to have the credentials as an Authorization HTTP header.
     * 
     * @param \Psr\Http\Client\ClientInterface Any http client compatible with Psr standards
     * @param string $method GET, POST, DELETE, PUT, PATCH.
     * @param string $uri ex. "https://api.4over.com/printproducts/productsfeed?product_uuid={uuid}" (entire uri not just '/printproducts/(...)')
     * 
     * @throws \InvalidArgumentException
     * 
     * @return \GuzzleHttp\Psr7\Request Prepared request with API credentials in proper place
     */
    private function prepareRequest(string $method, string $uri) : Request
    {
        self::throwExceptionIfMethodNotAllowed($method);

        $publicKey = $this->getPublicKey();
        $signature = $this->getSignature($method);

        // URL parameters
        $uri .= "?apikey=$publicKey&signature=$signature";

        // ... and HTTP header
        $headers = ['Authorization' => "API $publicKey:$signature"];

        return new Request($method, $uri, $headers);
    }

    /**
     * @return \Psr\Http\Client\ClientInterface
     */
    private function getHttpClient() : \Psr\Http\Client\ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @param string $httpMethod GET, POST etc.
     * 
     * @return string Prepared, hashed, and ready to use signature
     */
    private function getSignature(string $httpMethod) : string 
    {
        self::throwExceptionIfMethodNotAllowed($httpMethod);

        return hash_hmac("sha256", $httpMethod, hash('sha256', $this->privateKey));
    }

    /**
     * @return string Public key
     */
    private function getPublicKey() : string
    {
        return $this->publicKey;
    }
}