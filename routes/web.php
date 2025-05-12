<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RegisterController;
use App\Models\KategoriModel;

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


// route halaman products
//Route::get('/category/food-beverage', [ProductController::class, 'foodBeverage']);
//Route::get('/category/beauty-health', [ProductController::class, 'beautyHealth']);
//Route::get('/category/home-care', [ProductController::class, 'homeCare']);
//Route::get('/category/baby-kid', [ProductController::class, 'babyKid']);

// route halaman user
//Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);
//route halaman penjualan

Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id} maka harus berupa angka

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function() { //artinya semua route di dalam group ini harus login dulu

//route ini hanya bisa diakses oleh manager dan admin
Route::middleware(['authorize:ADM,MNG'])->group(function() {
  Route::group(['prefix' => 'level'], function () {
    Route::post('/', [LevelController::class, 'index']); // Menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']); // Menampilkan data level dalam bentuk JSON untuk DataTables
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru
    Route::get('/{id}', [LevelController::class, 'show']); // Menampilkan detail level
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Tampilan form delete level AJAX
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Hapus data level AJAX
    Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus data level
    Route::get('/import', [LevelController::class, 'import']);
    Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
    Route::get('/export_excel', [LevelController::class, 'export_excel']); // export excel

  });
});

//Route::get('/sales', [SalesController::class, 'index']);
Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user_tambah');
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);
Route::middleware(['authorize:ADM'])->group(function() {
Route::group(['prefix' => 'user'], function () {
  Route::post('/', [UserController::class, 'index']); // menampilkan halaman awal user
  Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
  Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user
  Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru
  Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
  Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
  Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user
  Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user
  Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);// tampilan form delete user ajax
  Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);// hapus data user ajax
  Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
  Route::get('/import', [UserController::class, 'import']);
  Route::post('/import_ajax', [UserController::class, 'import_ajax']);
  Route::get('/export_excel', [UserController::class, 'export_excel']); // export excel
});
});
});

Route::middleware(['authorize:ADM,STF'])->group(function() {
Route::group(['prefix' => 'kategori'], function () {
  Route::post('/', [KategoriController::class, 'index']); // Menampilkan halaman awal kategori
  Route::post('/list', [KategoriController::class, 'list']); // Menampilkan data kategori dalam JSON untuk DataTables
  Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan form tambah kategori
  Route::post('/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data kategori baru
  Route::get('/{id}', [KategoriController::class, 'show']); // Menampilkan detail kategori
  Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
  Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // Menampilkan form edit kategori
  Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // Menyimpan perubahan data kategori
  Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Tampilan form delete kategori AJAX
  Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Hapus data kategori AJAX
  Route::delete('/{id}', [KategoriController::class, 'destroy']); // Menghapus data kategori
  Route::get('/import', [KategoriController::class, 'import']);
  Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);
  Route::get('/export_excel', [KategoriController::class, 'export_excel']); // export excel
});
});

Route::middleware(['authorize:ADM,STF,MNG'])->group(function() {
Route::group(['prefix' => 'supplier'], function () {
  Route::match(['get', 'post'],'/', [SupplierController::class, 'index']); // Halaman awal supplier
  Route::post('/list', [SupplierController::class, 'list']); // DataTables JSON
  Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Form tambah supplier
  Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Simpan supplier baru
  Route::get('/{id}', [SupplierController::class, 'show']); // Detail supplier
  Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
  Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); // Form edit supplier
  Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // Update supplier
  Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Konfirmasi hapus supplier AJAX
  Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Hapus supplier AJAX
  Route::delete('/{id}', [SupplierController::class, 'destroy']); // Hapus supplier
  Route::get('/import', [SupplierController::class, 'import']);
  Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);
    Route::get('/export_excel', [SupplierController::class, 'export_excel']); // export excel
});

Route::middleware(['authorize:ADM,STF'])->group(function() {
Route::group(['prefix' => 'barang'], function () {
  Route::match(['get', 'post'],'/', [BarangController::class, 'index']); // Halaman awal barang
  Route::post('/list', [BarangController::class, 'list']); // DataTables JSON
  Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Form tambah barang
  Route::post('/ajax', [BarangController::class, 'store_ajax']); // Simpan barang baru
  Route::get('/{id}', [BarangController::class, 'show']); // Detail barang
   Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);
  Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // Form edit barang
  Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // Update barang
  Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Konfirmasi hapus barang AJAX
  Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Hapus barang AJAX
  Route::delete('/{id}', [BarangController::class, 'destroy']); // Hapus barang
  Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
  Route::post('/import_ajax', [BarangController::class, 'import_ajax']); // ajax import excel
  Route::get('/export_excel', [BarangController::class, 'export_excel']); // export excel
  Route::get('/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
});
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
});