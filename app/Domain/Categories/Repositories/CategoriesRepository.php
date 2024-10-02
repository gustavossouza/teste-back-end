<?php

namespace App\Domain\Categories\Repositories;

use App\Domain\Supports\Repositories\GlobalRepositories;
use App\Domain\Categories\Entities\Categories;

class CategoriesRepository extends GlobalRepositories
{
    public function __construct(Categories $categories)
    {
        parent::__construct($categories);
    }
}