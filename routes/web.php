<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [\App\Http\Controllers\LinkController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/links', [\App\Http\Controllers\LinkController::class, 'store'])->middleware(['auth'])->name('links.store');
Route::get('/{shortLink}', [\App\Http\Controllers\LinkController::class, 'redirect'])->name('short.redirect');
Route::get('/link/{id}/info', [\App\Http\Controllers\LinkController::class, 'statistics'])->middleware(['auth'])->name('link.stat');
Route::delete('/link/{id}/delete', [\App\Http\Controllers\LinkController::class, 'delete'])->middleware(['auth'])->name('link.delete');




