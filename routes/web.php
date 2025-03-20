<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

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
