<?php

use App\Http\Controllers\EspacioPersonalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::group(['prefix' => 'user/individual'], function () {
        Route::get('/read', [EspacioPersonalController::class, 'read'])->name('espaciopersonal.read');
        Route::get('/create', [EspacioPersonalController::class, 'create'])->name('espaciopersonal.create');
        Route::post('/store', [EspacioPersonalController::class, 'store'])->name('espaciopersonal.store');
        Route::get('/{id}/edit', [EspacioPersonalController::class, 'edit'])->name('espaciopersonal.edit');
        Route::put('/{id}', [EspacioPersonalController::class, 'update'])->name('espaciopersonal.update');
        Route::delete('/{id}', [EspacioPersonalController::class, 'destroy'])->name('espaciopersonal.destroy');
    });
});



Route::get('/table', [TableController::class, 'index'])->name('table.index');
Route::get('/table/{id}', [TableController::class, 'show'])->name('table.show');

require __DIR__ . '/auth.php';
require __DIR__ . '/auth.php';
