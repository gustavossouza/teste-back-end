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

    public function getByName(string $name): ?Categories
    {
        return $this->entity
            ->where('name', $name)
            ->first();
    }
}