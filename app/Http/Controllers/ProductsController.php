<?php

namespace App\Http\Controllers;


class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        
    }
    
    public function edit(int $id)
    {
        return view('categories.edit');
    }
}