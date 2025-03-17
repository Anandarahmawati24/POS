<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;

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

//Route::get('/', function () {
  //  return view('welcome');
//});

//route halaman home
//Route::get('/', [HomeController::class, 'index'])->name('home');

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
Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user_tambah');
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);
Route::group(['prefix' => 'user'], function () {
  Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
  Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
  Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
  Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
  Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
  Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
  Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
  Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
  Route::get('/', [LevelController::class, 'index']); // Halaman awal level
  Route::post('/list', [LevelController::class, 'list']); // DataTables JSON
  Route::get('/create', [LevelController::class, 'create']); // Form tambah level
  Route::post('/', [LevelController::class, 'store']); // Simpan level baru
  Route::get('/{id}', [LevelController::class, 'show']); // Detail level
  Route::get('/{id}/edit', [LevelController::class, 'edit']); // Form edit level
  Route::put('/{id}', [LevelController::class, 'update']); // Update level
  Route::delete('/{id}', [LevelController::class, 'destroy']); // Hapus level
});