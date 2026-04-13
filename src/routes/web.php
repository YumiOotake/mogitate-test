<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/products', [ProductController::class, 'index'])->name('index');
Route::get('/products/detail/{productId}', [ProductController::class, 'show'])->name('show');
Route::patch('/products/{productId}/update', [ProductController::class, 'update'])->name('update');
Route::get('/products/register', [ProductController::class, 'create'])->name('create');
Route::post('/products/register', [ProductController::class, 'store'])->name('store');
Route::get('/products/search', [ProductController::class, 'search'])->name('search');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('destroy');
