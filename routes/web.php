<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'login');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::resource('account', AccountController::class);


    // Route::resource('user', UserController::class);
    // Route::prefix('tempat')->group(function () {
    //     Route::resource('kategori', KategoriController::class);
    //     Route::resource('lokasi', LokasiController::class);
    //     Route::resource('destinasi', DestinasiController::class);
    // });
    // Route::resource('like', LikeController::class);
});
