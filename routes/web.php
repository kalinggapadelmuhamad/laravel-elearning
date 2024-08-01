<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\StudiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
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

Route::get('/', [DashboardController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('account', AccountController::class);

    // Route::prefix('studi')->group(function () {
    //     Route::get('mapels/{mapel}', [StudiController::class, 'detailMapel'])->name('detailMapel');
    //     Route::get('mapels/semester/{mapel}/{semester}', [StudiController::class, 'detailMapelSemester'])->name('detailMapelSemester');
    // });

    Route::middleware('App\http\Middleware\Admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::prefix('studi')->group(function () {

            Route::resource('materi', MateriController::class);
            Route::resource('mapel', MapelController::class);
        });
    });
});

Route::prefix('studi')->group(function () {
    Route::get('mapels/{mapel}', [StudiController::class, 'detailMapel'])->name('detailMapel');
    Route::get('mapels/semester/{mapel}/{semester}', [StudiController::class, 'detailMapelSemester'])->name('detailMapelSemester');
});
