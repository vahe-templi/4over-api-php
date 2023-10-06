<?php

namespace FourOver\Services;

use FourOver\Entities\Product\ProductList;
use FourOver\Entities\Product\Product;

class ProductService extends AbstractService
{
    // @TODO Page iteration
    /**
     * https://api-users.4over.com/?page_id=98
     *
     * @return ProductList
     */
    public function getAllProducts() : ProductList
    {
        return $this->getResource('GET', '/printproducts/productsfeed', [], Product::class, ProductList::class);
    }

    public function getAllProductCategories()
    {
        // @TODO
    }
}