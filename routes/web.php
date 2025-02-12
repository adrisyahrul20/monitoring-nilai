<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\LandingController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('stat-page');
Route::get('/raport', [LandingController::class, 'raport'])->name('raport-page');
Route::post('/search', [LandingController::class, 'search'])->name('home-search');
Route::get('/nilai', [LandingController::class, 'nilai'])->name('home-nilai');
Route::get('/export-pdf', [PDFController::class, 'exportPDF'])->name('export-pdf');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
        Route::get('/chart', 'chart')->name('chart');
        Route::get('/chart/detail', 'detail')->name('chart.detail');
    });
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
    Route::prefix('nilai')->name('nilai.')->controller(NilaiController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/nilai', 'nilai')->name('nilai');
        Route::post('/search', 'search')->name('search');

        Route::prefix('input')->name('input.')->group(function () {
            Route::get('/', 'input')->name('input');
            Route::get('/siswa', 'siswa')->name('siswa');
            Route::get('/nilai', 'inputNilai')->name('mapel');
        });
        Route::get('/data-table', 'datatable')->name('datatable');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    Route::prefix('siswa')->name('siswa.')->controller(SiswaController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data-table', 'datatable')->name('datatable');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    Route::prefix('mapel')->name('mapel.')->controller(MapelController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data-table', 'datatable')->name('datatable');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    Route::prefix('kelas')->name('kelas.')->controller(KelasController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data-table', 'datatable')->name('datatable');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    Route::prefix('guru')->name('guru.')->controller(GuruController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data-table', 'datatable')->name('datatable');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });

    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data-table', 'datatable')->name('datatable');
        Route::post('/store', 'store')->name('store');
        Route::put('/update', 'update')->name('update');
        Route::delete('/delete', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/auth.php';
