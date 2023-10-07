<?php

namespace FourOver;

use FourOver\Services\ServiceFactory;
use FourOver\Services\ServiceInterface;

class FourOverApiClient extends BaseApiClient {

    /**
     * @var ServiceFactory
     */
    private ServiceFactory $serviceFactory;

    /**
     * @param string $public_key
     * @param string $private_key
     * @param string $environmentType either 'LIVE' or 'SANDBOX'
     */
    public function __construct(string $public_key, string $private_key, string $environmentType)
    {
        parent::__construct($public_key, $private_key, $environmentType);

        $this->serviceFactory = new ServiceFactory();
    }

    /**
     * @param string $value
     * @throws \InvalidArgumentException
     * @return ServiceInterface
     */
    public function __get(string $value) : ServiceInterface
    {
        $classToInitialize = $this->serviceFactory->getServiceClass($value);
        $service = new $classToInitialize($this);

        if($service !== null)
            return $service;

        throw new \InvalidArgumentException("Undefined property $value.");
    }
}