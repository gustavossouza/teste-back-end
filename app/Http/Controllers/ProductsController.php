<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = $request->all();
        $response = Http::get('nginx/api/products', $queryParams);
        $responseCategories = Http::get('nginx/api/categories');

        if ($response->successful()) {
            $products = $response->json()['data'];
            $categories = $responseCategories->json()['data'];
            return view('products.index', compact('products', 'categories', 'queryParams'));
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
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        $title = $validatedData['title'];
        $price = $validatedData['price'];
        $description = $validatedData['description'];
        $category_id = $validatedData['category_id'];
        $image_url = $validatedData['image_url']??null;

        $response = Http::post('nginx/api/products', [
            'title' => $title,
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
        $response = Http::get("nginx/api/products/{$id}");
        $responseCategories = Http::get('nginx/api/categories');
        
        if ($response->successful()) {
            $product = $response->json()['data'];
            $categories = $responseCategories->json()['data'];
            return view('products.edit', compact('product', 'categories'));
        }
        return view('products.edit')->with('error', 'Falha ao carregar dados do usuário.');
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        $title = $validatedData['title'];
        $price = $validatedData['price'];
        $description = $validatedData['description'];
        $category_id = $validatedData['category_id'];
        $image_url = $validatedData['image_url']??null;

        $response = Http::put("nginx/api/products/{$id}", [
            'title' => $title,
            'price' => $price,
            'description' => $description,
            'category_id' => $category_id,
            'image_url' => $image_url,
        ]);

        if ($response->successful()) {
            return redirect()->route('products.index');
        }

        return redirect()->route('products.edit', ['id' => $id]);
    }

    public function destroy(int $id)
    {
        $response = Http::delete("nginx/api/products/{$id}");

        return redirect()->route('products.index');
    }
}