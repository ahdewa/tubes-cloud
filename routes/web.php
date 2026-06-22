<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Mengarahkan halaman utama langsung ke daftar mahasiswa
Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});

// Otomatis membuat routing URL untuk index, create, store, edit, update, destroy
Route::resource('mahasiswa', MahasiswaController::class);