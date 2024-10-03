<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
{
    public function index()
    {
        $response = Http::get('nginx/api/products');

        if ($response->successful()) {
            $products = $response->json()['data'];
            return view('products.index', compact('products'));
        }
        return view('products.index');
    }

    public function create()
    {
        $responseCategories = Http::get('nginx/api/categories');
        if ($responseCategories->successful()) {
            $categories = $responseCategories->json()['data'];
            return view('products.create', compact('categories'));
        }
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        $name = $validatedData['name'];
        $price = $validatedData['price'];
        $description = $validatedData['description'];
        $category_id = $validatedData['category_id'];
        $image_url = $validatedData['image_url']??null;

        $response = Http::post('nginx/api/products', [
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $category_id,
            'image_url' => $image_url,
        ]);

        if ($response->successful()) {
            return redirect()->route('products.index');
        }

        return redirect()->route('products.create');
    }

    public function edit(int $id)
    {
        return view('products.edit');
    }

    public function destroy(int $id)
    {
        $response = Http::delete("nginx/api/products/{$id}");

        return redirect()->route('products.index');
    }
}