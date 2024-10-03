<?php

namespace App\Domain\Supports\Fakes;

use Illuminate\Support\Facades\Http;

class FakesService
{
    private string $url = 'https://fakestoreapi.com';

    public function getProducts(int $productId = null)
    {
        if (is_null($productId)) {
            $response = Http::get("{$this->url}/products");
        } else {
            $response = Http::get("{$this->url}/products/{$productId}");
        }

        if ($response->successful()) {
            $products = $response->json();
            if (!is_array($products) || isset($products['id'])) {
                $products = [$products];
            }
            return $products;
        }

        return null;  
    }
}