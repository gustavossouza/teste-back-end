<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    public function index()
    {
        $response = Http::get('nginx/api/users');

        if ($response->successful()) {
            $users = $response->json()['data'];
            return view('users.index', compact('users'));
        }
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'cellphone' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $cellphone = $validatedData['cellphone'];
        $password = $validatedData['password'];

        $response = Http::post('nginx/api/users', [
            'name' => $name,
            'email' => $email,
            'cellphone' => $cellphone,
            'password' => $password,
        ]);

        if ($response->successful()) {
            return redirect()->route('users.index');
        }

        return redirect()->route('users.create');
    }

    public function edit(int $id)
    {
        $response = Http::get("nginx/api/users/{$id}");

        if ($response->successful()) {
            $user = $response->json()['data'];
            return view('users.edit', compact('user'));
        }
        return view('users.edit')->with('error', 'Falha ao carregar dados do usuário.');
    }

    public function destroy(int $id)
    {
        $response = Http::delete("nginx/api/users/{$id}");

        return redirect()->route('users.index');
    }

}