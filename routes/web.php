<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard.index');
})->name('home')->middleware('auth');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('post.login')->middleware('guest');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard')->middleware('auth');

// Route::resource('stock-barang', StockBarangController::class);
// Route::resource('barang-masuk', BarangMasukController::class);
// Route::resource('barang-keluar', BarangKeluarController::class);
// Route::resource('user', UserController::class);

// Route for user management
Route::group(['middleware' => ['auth', 'permission:user.list|user.create|user.edit|user.delete']], function () {
    Route::resource('user', UserController::class);
});

Route::group(['middleware' => ['auth', 'permission:user.create']], function () {
    Route::resource('user', UserController::class)->only(['create', 'store']);
});

Route::group(['middleware' => ['auth', 'permission:user.edit']], function () {
    Route::resource('user', UserController::class)->only(['edit', 'update']);
});

Route::group(['middleware' => ['auth', 'permission:user.delete']], function () {
    Route::resource('user', UserController::class)->only(['destroy']);
});

// Route for stock barang management
Route::group(['middleware' => ['auth', 'permission:stock-barang.list|stock-barang.create|stock-barang.edit|stock-barang.delete']], function () {
    Route::resource('stock-barang', StockBarangController::class);
});

Route::group(['middleware' => ['auth', 'permission:stock-barang.create']], function () {
    Route::resource('stock-barang', StockBarangController::class)->only(['create', 'store']);
});

Route::group(['middleware' => ['auth', 'permission:stock-barang.edit']], function () {
    Route::resource('stock-barang', StockBarangController::class)->only(['edit', 'update']);
});

Route::group(['middleware' => ['auth', 'permission:stock-barang.delete']], function () {
    Route::resource('stock-barang', StockBarangController::class)->only(['destroy']);
});

// Route for barang masuk management
Route::group(['middleware' => ['auth', 'permission:barang-masuk.list|barang-masuk.create|barang-masuk.edit|barang-masuk.delete']], function () {
    Route::resource('barang-masuk', BarangMasukController::class);
});

Route::group(['middleware' => ['auth', 'permission:barang-masuk.create']], function () {
    Route::resource('barang-masuk', BarangMasukController::class)->only(['create', 'store']);
});

Route::group(['middleware' => ['auth', 'permission:barang-masuk.edit']], function () {
    Route::resource('barang-masuk', BarangMasukController::class)->only(['edit', 'update']);
});

Route::group(['middleware' => ['auth', 'permission:barang-masuk.delete']], function () {
    Route::resource('barang-masuk', BarangMasukController::class)->only(['destroy']);
});

// Route for barang keluar management
Route::group(['middleware' => ['auth', 'permission:barang-keluar.list|barang-keluar.create|barang-keluar.edit|barang-keluar.delete']], function () {
    Route::resource('barang-keluar', BarangKeluarController::class);
});

Route::group(['middleware' => ['auth', 'permission:barang-keluar.create']], function () {
    Route::resource('barang-keluar', BarangKeluarController::class)->only(['create', 'store']);
});

Route::group(['middleware' => ['auth', 'permission:barang-keluar.edit']], function () {
    Route::resource('barang-keluar', BarangKeluarController::class)->only(['edit', 'update']);
});

Route::group(['middleware' => ['auth', 'permission:barang-keluar.delete']], function () {
    Route::resource('barang-keluar', BarangKeluarController::class)->only(['destroy']);
});

// Route for laporan management
Route::group(['middleware' => ['auth', 'permission:laporan.list']], function () {
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('laporan', [LaporanController::class, 'generate'])->name('laporan.generate');
});
