<?php

namespace App\Domain\Products\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Products\Repositories\ProductsRepository;

class ProductsService extends GlobalServices
{
    public function __construct(
        protected ProductsRepository $repository
    )
    {}
}