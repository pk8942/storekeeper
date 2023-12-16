<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products/create', [ProductController::class, 'create']);
Route::post('/products/store', [ProductController::class, 'store']);
Route::post('/products/sell/{id}', [ProductController::class, 'sell']);
Route::post('/products/change-price/{id}', [ProductController::class, 'changePrice']);

Route::get('/dashboard', [ProductController::class, 'dashboard']);
Route::get('/sales-history', [ProductController::class, 'salesHistory']);
