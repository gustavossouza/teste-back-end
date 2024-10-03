<?php

namespace App\Domain\Products\Services;

use App\Domain\Supports\Services\GlobalServices;
use App\Domain\Products\Repositories\ProductsRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Domain\Products\Entities\Products;

class ProductsService extends GlobalServices
{
    public function __construct(
        protected ProductsRepository $repository
    )
    {}

    public function get(array $filters = []): Collection
    {
        $query = $this->repository->query();

        if (isset($filters['product_id'])) {
            $query->where('id', $filters['product_id']);
        }

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (isset($filters['image_filter'])) {
            if ($filters['image_filter'] === 'with_image') {
                $query->whereNotNull('image_url');
            } elseif ($filters['image_filter'] === 'without_image') {
                $query->whereNull('image_url');
            }
        }

        return $query->get();
    }

    public function create(array $data): Products
    {
        if ($this->isDuplicate(['name' => $data['name']])) {
            throw new \Exception('Este nome de produto já está em uso.');
        }

        return parent::create($data);
    }

    public function update(array $data, int $productId): Products
    {
        if ($this->isDuplicate(['name' => $data['name']])) {
            throw new \Exception('Este nome já está em uso.');
        }

        return parent::update($data, $productId);
    }
}