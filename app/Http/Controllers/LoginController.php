<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $response = Http::post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        dd($response->json());

        if ($response->successful()) {
            $token = $response->json('token');

            return redirect()->route('dashboard')->with('token', $token);
        }

        return back()->withErrors([
            'email' => 'As credenciais não estão corretas.',
        ]);
    }
}