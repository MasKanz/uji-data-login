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
use App\Http\Controllers\MotorController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\KreditController;
use App\Http\Controllers\MetodeBayarController;


// Front Page
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/shop', [ProductPageController::class, 'index'])->name('products');
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/abouts', [AboutController::class, 'index']);

Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan')->middleware(CheckPelanggan::class);
Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store')->middleware(CheckPelanggan::class);

Route::get('/shop/{id}', [ProductPageController::class, 'show'])->name('products.show');
Route::get('/pembayaran', [PembayaranController::class, 'index']);

Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran')->middleware(CheckPelanggan::class);
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store')->middleware(CheckPelanggan::class);

Route::get('/profilepelanggan', [PelangganController::class, 'profilePelanggan'])->name('pelanggan.profile')->middleware(CheckPelanggan::class);
Route::get('/updatepelanggan', [PelangganController::class, 'updatePage'])->middleware(CheckPelanggan::class);
Route::post('/pelanggan/update-alamat', [PelangganController::class, 'updateAlamat'])->name('pelanggan.updateAlamat');

Route::get('/pengajuan-saya', [PengajuanController::class, 'listPengajuanPelanggan'])->name('pengajuan.pelanggan')->middleware(CheckPelanggan::class);
Route::post('/pengajuan-saya/{id}/batal', [PengajuanController::class, 'batalPengajuanPelanggan'])->name('pengajuan.pelanggan.batal')->middleware(CheckPelanggan::class);
Route::get('/kredit-saya', [PengajuanController::class, 'listKreditPelanggan'])->name('kredit.pelanggan')->middleware(CheckPelanggan::class);


// Pelanggan Auth
Route::get('/daftar', [PelangganController::class, 'page_daftar'])->name('daftar');
Route::post('/daftar', [PelangganController::class, 'daftar']);
Route::get('/masuk', [PelangganController::class, 'page_masuk'])->name('masuk')->middleware(MasukPelangganCheck::class);
Route::post('/masuk', [PelangganController::class, 'masuk']);
Route::post('/keluar', [PelangganController::class, 'keluar'])->middleware('auth');
Route::post('/keluar', [PelangganController::class, 'keluar'])->middleware('auth:pelanggan');


// Dashboard Users Auth
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware(LoginUserCheck::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


// Dashboard
Route::get('/admin', [AdminController::class, 'index'])->middleware(CheckUserRole::class . ':admin');
Route::get('/marketing', [MarketingController::class, 'index'])->middleware(CheckUserRole::class . ':marketing');
Route::get('/ceo', [CeoController::class, 'index'])->middleware(CheckUserRole::class . ':ceo');


// Dashboard Users Management
Route::get('/users', [AuthController::class, 'updateUserPage'])->name('users')->middleware(CheckUserRole::class . ':admin');
Route::get('/users/create', [AuthController::class, 'createUserPage'])->name('users.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/users', [AuthController::class, 'storeUser'])->name('users.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/users/{id}/edit', [AuthController::class, 'editUserPage'])->name('users.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/users/{id}', [AuthController::class, 'updateUser'])->name('users.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');
Route::patch('/users/{id}/toggle-active', [AuthController::class, 'toggleActive'])->name('users.toggleActive');



// Pelanggan Management
Route::get('/pelanggans', [PelangganController::class, 'showPelangganPage'])->name('pelanggans')->middleware(CheckUserRole::class . ':admin');
Route::get('/pelanggans/create', [PelangganController::class, 'createPelangganPage'])->name('pelanggans.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/pelanggans', [PelangganController::class, 'storePelanggan'])->name('pelanggans.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/pelanggans/{id}/edit', [PelangganController::class, 'editPelangganPage'])->name('pelanggans.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/pelanggans/{id}', [PelangganController::class, 'updatePelanggan'])->name('pelanggans.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/pelanggans/{id}', [PelangganController::class, 'destroy'])->name('pelanggans.destroy');
Route::patch('/pelanggans/{id}/toggle-aktif', [PelangganController::class, 'toggleAktif'])->name('pelanggans.toggleAktif');



// Motor Management
Route::get('/motors', [MotorController::class, 'index'])->name('motors')->middleware(CheckUserRole::class . ':admin');
Route::get('/motors/create', [MotorController::class, 'createMotorPage'])->name('motors.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/motors', [MotorController::class, 'storeMotor'])->name('motors.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/motors/{id}', [MotorController::class, 'showMotorDetail'])->name('motors.detail')->middleware(CheckUserRole::class . ':admin');
Route::get('/motors/{id}/edit', [MotorController::class, 'editMotorPage'])->name('motors.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/motors/{id}', [MotorController::class, 'updateMotor'])->name('motors.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/motors/{id}', [MotorController::class, 'destroyMotor'])->name('motors.destroy')->middleware(CheckUserRole::class . ':admin');


// Jenis Motor Management
Route::get('/jenis-motors', [MotorController::class, 'indexJenisMotor'])->name('jenis-motors')->middleware(CheckUserRole::class . ':admin');
Route::get('/jenis-motors/create', [MotorController::class, 'createJenisMotorPage'])->name('jenis-motors.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/jenis-motors', [MotorController::class, 'storeJenisMotor'])->name('jenis-motors.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/jenis-motors/{id}/edit', [MotorController::class, 'editJenisMotorPage'])->name('jenis-motors.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/jenis-motors/{id}', [MotorController::class, 'updateJenisMotor'])->name('jenis-motors.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/jenis-motors/{id}', [MotorController::class, 'destroyJenisMotor'])->name('jenis-motors.destroy')->middleware(CheckUserRole::class . ':admin');
Route::get('/jenis-motors/{id}', [MotorController::class, 'showJenisMotorDetail'])->name('jenis-motors.detail')->middleware(CheckUserRole::class . ':admin');



// Jenis Cicilan Management
Route::get('/jenis-cicilan', [PengajuanController::class, 'indexJenisCicilan'])->name('jenis-cicilan')->middleware(CheckUserRole::class . ':admin');
Route::get('/jenis-cicilan/create', [PengajuanController::class, 'createJenisCicilanPage'])->name('jenis-cicilan.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/jenis-cicilan', [PengajuanController::class, 'storeJenisCicilan'])->name('jenis-cicilan.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/jenis-cicilan/{id}/edit', [PengajuanController::class, 'editJenisCicilanPage'])->name('jenis-cicilan.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/jenis-cicilan/{id}', [PengajuanController::class, 'updateJenisCicilan'])->name('jenis-cicilan.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/jenis-cicilan/{id}', [PengajuanController::class, 'destroyJenisCicilan'])->name('jenis-cicilan.destroy')->middleware(CheckUserRole::class . ':admin');


// Asuransi Management
Route::get('/asuransi', [AsuransiController::class, 'index'])->name('asuransi')->middleware(CheckUserRole::class . ':admin');
Route::get('/asuransi/create', [AsuransiController::class, 'create'])->name('asuransi.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/asuransi', [AsuransiController::class, 'store'])->name('asuransi.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/asuransi/{id}/edit', [AsuransiController::class, 'edit'])->name('asuransi.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/asuransi/{id}', [AsuransiController::class, 'update'])->name('asuransi.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/asuransi/{id}', [AsuransiController::class, 'destroy'])->name('asuransi.destroy')->middleware(CheckUserRole::class . ':admin');


// Metode Bayar Management
Route::get('/metode-bayar', [MetodeBayarController::class, 'index'])->name('metode-bayar')->middleware(CheckUserRole::class . ':admin');
Route::get('/metode-bayar/create', [MetodeBayarController::class, 'create'])->name('metode-bayar.create')->middleware(CheckUserRole::class . ':admin');
Route::post('/metode-bayar', [MetodeBayarController::class, 'store'])->name('metode-bayar.store')->middleware(CheckUserRole::class . ':admin');
Route::get('/metode-bayar/{id}/edit', [MetodeBayarController::class, 'edit'])->name('metode-bayar.edit')->middleware(CheckUserRole::class . ':admin');
Route::put('/metode-bayar/{id}', [MetodeBayarController::class, 'update'])->name('metode-bayar.update')->middleware(CheckUserRole::class . ':admin');
Route::delete('/metode-bayar/{id}', [MetodeBayarController::class, 'destroy'])->name('metode-bayar.destroy')->middleware(CheckUserRole::class . ':admin');


// Pengajuan Kredit Management
Route::get('/pengajuan-kredit', [PengajuanController::class, 'indexPengajuanKredit'])->name('pengajuan-kredit')->middleware(CheckUserRole::class . ':admin,marketing');
Route::get('/pengajuan-kredit/{id}', [PengajuanController::class, 'showPengajuanDetail'])->name('pengajuan-kredit.show')->middleware(CheckUserRole::class . ':admin,marketing');
Route::post('/pengajuan-kredit/{id}/konfirmasi', [PengajuanController::class, 'konfirmasiPengajuan'])->name('pengajuan-kredit.konfirmasi')->middleware(CheckUserRole::class . ':admin,marketing');
Route::post('/pengajuan-kredit/{id}/batal', [PengajuanController::class, 'batalPengajuan'])->name('pengajuan-kredit.batal')->middleware(CheckUserRole::class . ':admin,marketing');


// Kredit Management
Route::get('/kredit', [KreditController::class, 'index'])->name('kredit')->middleware(CheckUserRole::class . ':admin,marketing');
Route::get('/kredit/{id}', [KreditController::class, 'show'])->name('kredit.show')->middleware(CheckUserRole::class . ':admin,marketing');
Route::get('/kredit/{id}/edit', [KreditController::class, 'edit'])->name('kredit.edit')->middleware(CheckUserRole::class . ':admin,marketing');
Route::put('/kredit/{id}', [KreditController::class, 'update'])->name('kredit.update')->middleware(CheckUserRole::class . ':admin,marketing');
Route::delete('/kredit/{id}', [KreditController::class, 'destroy'])->name('kredit.destroy')->middleware(CheckUserRole::class . ':admin,marketing');


// Angsuran Management
Route::get('/angsuran-verifikasi', [PembayaranController::class, 'verifikasiList'])->name('angsuran-verifikasi')->middleware(CheckUserRole::class . ':admin,marketing');
Route::post('/angsuran-verifikasi/{id}/terima', [PembayaranController::class, 'terimaAngsuran'])->name('angsuran-verifikasi.terima')->middleware(CheckUserRole::class . ':admin,marketing');
Route::post('/angsuran-verifikasi/{id}/tolak', [PembayaranController::class, 'tolakAngsuran'])->name('angsuran-verifikasi.tolak')->middleware(CheckUserRole::class . ':admin,marketing');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
