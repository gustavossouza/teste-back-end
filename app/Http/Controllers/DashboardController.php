<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('nginx/api/dashboard');

        if ($response->successful()) {
            $dashboard = $response->json()['data'];
            return view('index', compact('dashboard'));
        }
        return view('index');
    }
}