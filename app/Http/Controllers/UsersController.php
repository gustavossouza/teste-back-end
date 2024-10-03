<?php

namespace App\Http\Controllers;


class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        
    }

    public function edit(int $id)
    {
        return view('categories.edit');
    }

}