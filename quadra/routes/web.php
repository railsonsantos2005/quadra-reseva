<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuadraController;

Route::get('/', [QuadraController::class, 'index'])->name('quadras.index');
Route::get('/quadras/create', [QuadraController::class, 'create'])->name('quadras.create');
Route::post('/quadras', [QuadraController::class, 'store'])->name('quadras.store');
Route::get('/quadras/{quadra}/edit', [QuadraController::class, 'edit'])->name('quadras.edit');
Route::put('/quadras/{quadra}', [QuadraController::class, 'update'])->name('quadras.update');
Route::delete('/quadras/{quadra}', [QuadraController::class, 'destroy'])->name('quadras.destroy');
