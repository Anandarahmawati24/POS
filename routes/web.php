<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;


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
  Route::post('/', [UserController::class, 'index']); // menampilkan halaman awal user
  Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
  Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user
  Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru
  Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
  Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user
  Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user
  Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);// tampilan form delete user ajax
  Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);// hapus data user ajax
  Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
  Route::post('/', [LevelController::class, 'index']); // Menampilkan halaman awal level
  Route::post('/list', [LevelController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
  Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level
  Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru
  Route::get('/{id}', [LevelController::class, 'show']); // Menampilkan detail level
  Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level
  Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level
  Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Tampilan form delete level AJAX
  Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Hapus data level AJAX
  Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus data level
});


Route::group(['prefix' => 'kategori'], function () {
  Route::get('/', [KategoriController::class, 'index']); // Halaman awal kategori
  Route::post('/list', [KategoriController::class, 'list']); // DataTables JSON
  Route::get('/create', [KategoriController::class, 'create']); // Form tambah kategori
  Route::post('/', [KategoriController::class, 'store']); // Simpan kategori baru
  Route::get('/{id}', [KategoriController::class, 'show']); // Detail kategori
  Route::get('/{id}/edit', [KategoriController::class, 'edit']); // Form edit kategori
  Route::put('/{id}', [KategoriController::class, 'update']); // Update kategori
  Route::delete('/{id}', [KategoriController::class, 'destroy']); // Hapus kategori
});

Route::group(['prefix' => 'supplier'], function () {
  Route::get('/', [SupplierController::class, 'index']); // Halaman awal supplier
  Route::post('/list', [SupplierController::class, 'list']); // DataTables JSON
  Route::get('/create', [SupplierController::class, 'create']); // Form tambah supplier
  Route::post('/', [SupplierController::class, 'store']); // Simpan supplier baru
  Route::get('/{id}', [SupplierController::class, 'show']); // Detail supplier
  Route::get('/{id}/edit', [SupplierController::class, 'edit']); // Form edit supplier
  Route::put('/{id}', [SupplierController::class, 'update']); // Update supplier
  Route::delete('/{id}', [SupplierController::class, 'destroy']); // Hapus supplier
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']); // Halaman daftar barang
    Route::post('/list', [BarangController::class, 'list']); // DataTables JSON
    Route::get('/create', [BarangController::class, 'create']); // Form tambah barang
    Route::post('/', [BarangController::class, 'store']); // Simpan barang baru
    Route::get('/{id}', [BarangController::class, 'show']); // Detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // Form edit barang
    Route::put('/{id}', [BarangController::class, 'update']); // Update barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // Hapus barang
});