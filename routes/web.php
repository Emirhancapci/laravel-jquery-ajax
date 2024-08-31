<?php

use App\Http\Controllers\IntroController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [IntroController::class, 'index'])->name('intro.list');
Route::get('create', [IntroController::class, 'create'])->name('intro.create');
Route::get('edit/{id}', [IntroController::class, 'edit'])->name('intro.edit');
Route::post('store', [IntroController::class, 'store'])->name('intro.store');
Route::put('update/{id}', [IntroController::class, 'update'])->name('intro.update');
Route::delete('delete/{id}', [IntroController::class, 'destroy'])->name('intro.delete');
