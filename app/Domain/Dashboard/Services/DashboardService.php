<?php

namespace App\Domain\Dashboard\Services;

use App\Domain\Categories\Services\CategoriesService;
use App\Domain\Products\Services\ProductsService;
use App\Domain\Users\Services\UsersService;

class DashboardService
{
    public function __construct(
        private CategoriesService $categoriesService,
        private ProductsService $productsService,
        private UsersService $usersService,
    )
    {}

    public function dashboard(): array
    {
        return [
            'quantity_users' => $this->usersService->count(),
            'quantity_products' => $this->productsService->count(),
            'quantity_categories' => $this->categoriesService->count()
        ];
    }
}