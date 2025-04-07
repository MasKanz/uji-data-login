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




Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/shop', [ProductPageController::class, 'index']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/abouts', [AboutController::class, 'index']);
Route::get('/pengajuan', [PengajuanController::class, 'index']);
Route::get('/pembayaran', [PembayaranController::class, 'index']);
Route::get('/daftar', [PelangganController::class, 'page_daftar'])->name('daftar');
Route::post('/daftar', [PelangganController::class, 'daftar']);
Route::get('/masuk', [PelangganController::class, 'page_masuk'])->name('masuk');
Route::post('/masuk', [PelangganController::class, 'masuk']);
Route::post('/keluar', [PelangganController::class, 'keluar'])->middleware('auth');

use App\Http\Middleware\CheckUserRole;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(CheckUserRole::class . ':admin');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware('admin');
    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->middleware('customer');
    Route::get('/ceo/dashboard', [DashboardController::class, 'ceo'])->middleware('ceo');
    Route::get('/marketing/dashboard', [DashboardController::class, 'marketing'])->middleware('marketing');
});
