<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $response = Http::post('nginx/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $token = $response->json('accessToken');
            Session::put('token', $token);

            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'email' => 'As credenciais não estão corretas.',
        ]);
    }
}