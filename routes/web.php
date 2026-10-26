<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KataController;
use App\Http\Controllers\Admin\KataRelasiController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KamusController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KuisController;

Route::get('/', [KamusController::class, 'beranda'])->name('kamus.beranda');
Route::get('/cari', [KamusController::class, 'cari'])->name('kamus.cari');
Route::get('/kata/{kata}', [KamusController::class, 'show'])->name('kamus.detail');
Route::get('/add/kuis', [SoalController::class, 'index'])->name('kuis');
Route::view('/tentang', 'tentang')->name('tentang');

Route::prefix('kuis')->name('kuis.')->group(function () {
    Route::get('/', [KuisController::class, 'index'])->name('index');
    Route::post('/', [KuisController::class, 'mulai'])->name('mulai');
    Route::get('/soal', [KuisController::class, 'soal'])->name('soal');
    Route::post('/selesai', [KuisController::class, 'selesai'])->name('selesai');
    Route::get('/hasil', [KuisController::class, 'hasil'])->name('hasil');
});



Route::get('/admin', function () {
    return view('template');
});

Route::get('/materi', function () {
    return view('materi.index');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
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
    Route::get('/add/kuis', [SoalController::class, 'index'])->name('add-kuis');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
    Route::get('/soal/create', [SoalController::class, 'create'])->name('soal.create');
    Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
    Route::get('/soal/{id}/edit', [SoalController::class, 'edit'])->name('soal.edit');
    Route::put('/soal/{id}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');
});

Route::get('/jawaban', [JawabanController::class, 'index'])->name('jawaban.index');
Route::get('/jawaban/create', [JawabanController::class, 'create'])->name('jawaban.create');
Route::post('/jawaban', [JawabanController::class, 'store'])->name('jawaban.store');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login/proses', [AuthController::class, 'proses'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/materi', function () {
    return view('materi.index');
})->name('materi.index');

Route::get('/materi/latar-belakang', function () { return view('materi.latar_belakang'); })->name('materi.latar_belakang');
Route::get('/materi/kruna-alus', function () { return view('materi.kruna_alus'); })->name('materi.kruna_alus');  
Route::get('/materi/alus-singgih', function () { return view('materi.alus_singgih'); })->name('materi.alus_singgih');
Route::get('/materi/alus-sor', function () { return view('materi.alus_sor'); })->name('materi.alus_sor');
Route::get('/materi/alus-mider', function () { return view('materi.alus_mider'); })->name('materi.alus_mider');
Route::get('/materi/alus-madia', function () {return view('materi.alus_madia'); })->name('materi.alus_madia');
Route::get('/materi/kruna-nenten-alus', function () { return view('materi.kruna_nenten_alus'); })->name('materi.kruna_nenten_alus');
Route::get('/materi/kruna-mider', function () { return view('materi.kruna_mider'); })->name('materi.kruna_mider');
Route::get('/materi/kruna-andap', function () { return view('materi.kruna_andap'); })->name('materi.kruna_andap');  
Route::get('/materi/kruna-kasar', function () { return view('materi.kruna_kasar'); })->name('materi.kruna_kasar');
Route::get('/materi/kesimpulan', function () { return view('materi.kesimpulan'); })->name('materi.kesimpulan'); 
