<?php

namespace App\Domain\Categories\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Categories\Repositories\CategoriesRepository;
use App\Domain\Categories\Entities\Categories;

class CategoriesService extends GlobalServices
{
    public function __construct(
        protected CategoriesRepository $repository
    )
    {}

    public function create(array $data): Categories
    {
        if ($this->isDuplicate(['name' => $data['name']])) {
            throw new \Exception('Este nome já está em uso.');
        }

        return parent::create($data);
    }

    public function update(array $data, int $categoryId): Categories
    {
        if ($this->isDuplicate(['name' => $data['name']])) {
            throw new \Exception('Este nome já está em uso.');
        }

        return parent::update($data, $categoryId);
    }

    public function findOrCreateByName(string $name): Categories
    {
        $category = $this->repository->getByName($name);
        if (is_null($category)) {
            $category = $this->create([
                'name' => $name
            ]);
        }
        return $category;
    }
}