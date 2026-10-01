<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KataController;
use App\Http\Controllers\Admin\KataRelasiController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KamusController;
use App\Http\Controllers\JawabanController;

Route::get('/', [KamusController::class, 'beranda'])->name('kamus.beranda');
Route::get('/cari', [KamusController::class, 'cari'])->name('kamus.cari');
Route::get('/kata/{kata}', [KamusController::class, 'show'])->name('kamus.detail');
 
Route::view('/tentang', 'tentang')->name('tentang');


Route::get('/admin', function () {
    return view('template');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kata', [KataController::class, 'index'])->name('kata.index');
    Route::get('/kata/create', [KataController::class, 'create'])->name('kata.create');
    Route::get('/kata/import', [KataController::class, 'importForm'])->name('kata.import.form');
    Route::post('/kata/import', [KataController::class, 'import'])->name('kata.import');
    Route::post('/kata', [KataController::class, 'store'])->name('kata.store');
    Route::get('/kata/{id}/edit', [KataController::class, 'edit'])->name('kata.edit');
    Route::put('/kata/{id}', [KataController::class, 'update'])->name('kata.update');
    Route::delete('/kata/{id}', [KataController::class, 'destroy'])->name('kata.destroy');
    Route::get('/kata/{kata}/relasi', [KataRelasiController::class, 'index'])->name('kata.relasi.index');
    Route::post('/kata/{kata}/relasi', [KataRelasiController::class, 'store'])->name('kata.relasi.store');
    Route::delete('/kata/{kata}/relasi/{tipe}/{terkait}', [KataRelasiController::class, 'destroy'])->name('kata.relasi.destroy');
});

Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
Route::get('/soal/create', [SoalController::class, 'create'])->name('soal.create');
Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
Route::get('/jawaban', [JawabanController::class, 'index'])->name('jawaban.index');
Route::get('/jawaban/create', [JawabanController::class, 'create'])->name('jawaban.create');
Route::post('/jawaban', [JawabanController::class, 'store'])->name('jawaban.store');

Route::get('/login', function () {
    return view('login');
})->name('login');
