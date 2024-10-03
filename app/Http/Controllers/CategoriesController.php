<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoriesController extends Controller
{
    public function index()
    {
        $response = Http::get('nginx/api/categories');

        if ($response->successful()) {
            $categories = $response->json()['data'];
            return view('categories.index', compact('categories'));
        }
        return view('categories.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = $validatedData['name'];

        $response = Http::post('nginx/api/categories', [
            'name' => $name,
        ]);

        if ($response->successful()) {
            return redirect()->route('categories.index');
        }

        return redirect()->route('categories.create');
    }

    public function edit(int $id)
    {
        return view('categories.edit');
    }

    public function destroy(int $id)
    {
        $response = Http::delete("nginx/api/categories/{$id}");

        return redirect()->route('categories.index');
    }
}