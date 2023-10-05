<?php

namespace FourOver\Services;

class ProductService extends AbstractService
{
    // @TODO Iterating pages
    public function getAllProducts()
    {
        return $this->request('GET', '/printproducts/productsfeed');
    }

    public function getAllProductCategories()
    {
        // @TODO
    }
}