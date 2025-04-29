<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\CeoController;
use App\Http\Middleware\CheckPelanggan;
use App\Http\Middleware\LoginUserCheck;
use App\Http\Middleware\MasukPelangganCheck;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/shop', [ProductPageController::class, 'index']);
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/abouts', [AboutController::class, 'index']);
Route::get('/pengajuan', [PengajuanController::class, 'index']);
Route::get('/pembayaran', [PembayaranController::class, 'index']);
Route::get('/profilepelanggan', [PelangganController::class, 'profilePelanggan'])->middleware(CheckPelanggan::class);
Route::get('/updatepelanggan', [PelangganController::class, 'updatePage'])->middleware(CheckPelanggan::class);
Route::post('/pelanggan/update-alamat', [PelangganController::class, 'updateAlamat'])->name('pelanggan.updateAlamat');


Route::get('/daftar', [PelangganController::class, 'page_daftar'])->name('daftar');
Route::post('/daftar', [PelangganController::class, 'daftar']);
Route::get('/masuk', [PelangganController::class, 'page_masuk'])->name('masuk')->middleware(MasukPelangganCheck::class);
Route::post('/masuk', [PelangganController::class, 'masuk']);
Route::post('/keluar', [PelangganController::class, 'keluar'])->middleware('auth');
Route::post('/keluar', [PelangganController::class, 'keluar'])->middleware('auth:pelanggan');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware(LoginUserCheck::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


Route::get('/admin', [AdminController::class, 'index'])->middleware(CheckUserRole::class . ':admin');
Route::get('/marketing', [MarketingController::class, 'index'])->middleware(CheckUserRole::class . ':marketing');
Route::get('/ceo', [CeoController::class, 'index'])->middleware(CheckUserRole::class . ':ceo');


Route::get('/users', [AuthController::class, 'updateUserPage'])->name('users')->middleware(CheckUserRole::class . ':admin');
Route::get('/users/create', [AuthController::class, 'createUserPage'])->name('users.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/users', [AuthController::class, 'storeUser'])->name('users.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/users/{id}/edit', [AuthController::class, 'editUserPage'])->name('users.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/users/{id}', [AuthController::class, 'updateUser'])->name('users.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');


Route::get('/pelanggans', [PelangganController::class, 'showPelangganPage'])->name('pelanggans')->middleware(CheckUserRole::class . ':admin');
Route::get('/pelanggans/create', [PelangganController::class, 'createPelangganPage'])->name('pelanggans.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/pelanggans', [PelangganController::class, 'storePelanggan'])->name('pelanggans.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/pelanggans/{id}/edit', [PelangganController::class, 'editPelangganPage'])->name('pelanggans.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/pelanggans/{id}', [PelangganController::class, 'updatePelanggan'])->name('pelanggans.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/pelanggans/{id}', [PelangganController::class, 'destroy'])->name('pelanggans.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
