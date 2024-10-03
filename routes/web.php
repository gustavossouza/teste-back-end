<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'index'])->name('login.index');;
Route::post('/login', [LoginController::class, 'store'])->name('login.store');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

/*
ROTA CATEGORIES
*/
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
Route::post('/categories/{$id}/update', [CategoriesController::class, 'update'])->name('categories.update');
Route::get('/categories/{$id}/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');


/*
ROTA PRODUCTS
*/
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
Route::post('/products/{$id}/update', [ProductsController::class, 'update'])->name('products.update');
Route::get('/products/{$id}/destroy', [ProductsController::class, 'destroy'])->name('products.destroy');

/*
ROTA USERS
*/
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
Route::post('/users/{$id}/update', [UsersController::class, 'update'])->name('users.update');
Route::get('/users/{$id}/delete', [UsersController::class, 'destroy'])->name('users.destroy');