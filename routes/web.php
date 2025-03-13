<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;


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

//route halaman home
Route::get('/', [HomeController::class, 'index'])->name('home');

// route halaman products
Route::get('/category/food-beverage', [ProductController::class, 'foodBeverage']);
Route::get('/category/beauty-health', [ProductController::class, 'beautyHealth']);
Route::get('/category/home-care', [ProductController::class, 'homeCare']);
Route::get('/category/baby-kid', [ProductController::class, 'babyKid']);

// route halaman user
//Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

//route halaman penjualan
Route::get('/sales', [SalesController::class, 'index']);

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);