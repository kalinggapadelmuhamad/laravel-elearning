<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\StudiController;
use App\Http\Controllers\UserController;
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


    Route::resource('users', UserController::class);
    Route::prefix('studi')->group(function () {
        Route::resource('mapel', MapelController::class);
        Route::get('mapels/{mapel}', [StudiController::class, 'detailMapel'])->name('detailMapel');
        Route::get('mapels/semester/{mapel}/{semester}', [StudiController::class, 'detailMapelSemester'])->name('detailMapelSemester');

        Route::resource('materi', MateriController::class);
        //     Route::resource('destinasi', DestinasiController::class);
    });
    // Route::resource('like', LikeController::class);
});
