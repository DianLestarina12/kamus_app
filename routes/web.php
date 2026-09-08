<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KataController;
use App\Http\Controllers\SoalController;

Route::get('/', function () {
    return view('template');
});

Route::get('/kata', [KataController::class, 'index'])->name('kata.index');
Route::get('/kata/create', [KataController::class, 'create'])->name('kata.create');
Route::post('/kata', [KataController::class, 'store'])->name('kata.store');
Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
Route::get('/soal/create', [SoalController::class, 'create'])->name('soal.create');
Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');