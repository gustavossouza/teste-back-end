<?php

namespace App\Domain\Categories\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Categories\Repositories\CategoriesRepository;

class CategoriesService extends GlobalServices
{
    public function __construct(
        protected CategoriesRepository $repository
    )
    {}
}