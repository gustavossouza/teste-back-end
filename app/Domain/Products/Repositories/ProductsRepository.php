<?php

namespace App\Domain\Products\Repositories;

use App\Domain\Supports\Repositories\GlobalRepositories;
use App\Domain\Products\Entities\Products;

class ProductsRepository extends GlobalRepositories
{
    public function __construct(Products $products)
    {
        parent::__construct($products);
    }
}