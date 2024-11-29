<?php

use App\Http\Controllers\EspacioPersonalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Models\TareaPersonalColumnas;

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


//hay que meterlos en un prefix todos tambien
Route::get('/personal', [EspacioPersonalController::class, 'index'])->name('table.index');
Route::get('/personal/{id}', [EspacioPersonalController::class, 'show'])->name('table.show');//modificar esos nombres

Route::get('/personal/{id}/crear',[TareaController::class,'create'])->name('task.create');
Route::post('personal/{id}',[TareaController::class,'store'])->name('task.store');

Route::get('/personal/{id}/editar',[TareaController::class,'edit'])->name('task.edit');
Route::put('/personal/{id}',[TareaController::class,'update'])->name('task.update');

Route::delete('/personal/{id}/eliminar', [TareaController::class, 'destroy'])->name('espaciopersonal.destroy');



require __DIR__ . '/auth.php';
require __DIR__ . '/auth.php';
