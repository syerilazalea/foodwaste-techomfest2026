<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.penyedia');
});

// Dashboard Group
Route::prefix('dashboard')->group(function () {

    //Route Index
    Route::get('/penyedia', function () {
        return view('dashboard.penyedia');
    })->name('dashboard.penyedia');

    Route::get('/penerima', function () {
        return view('dashboard.penerima');
    })->name('dashboard.penerima');

    // Route Katalog
    Route::prefix('katalog')->group(function () {
        Route::get('/daur-ulang', function () {
            return view('dashboard.katalog-daur-ulang');
        })->name('dashboard.katalog.daur-ulang');

        Route::get('/makanan', function () {
            return view('dashboard.katalog-makanan');
        })->name('dashboard.katalog.makanan');
    });

    // Route Tabel
    Route::prefix('tabel')->group(function () {
        Route::get('/makanan', function () {
            return view('dashboard.tabel-makanan');
        })->name('dashboard.tabel.makanan');

        Route::get('/daur-ulang', function () {
            return view('dashboard.tabel-daur-ulang');
        })->name('dashboard.tabel.daur-ulang');
    });

});
