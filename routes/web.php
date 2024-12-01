<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EspacioPersonalController;
use App\Http\Controllers\EspacioGrupalController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

use App\Http\Controllers\TareaGrupalController;
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

    Route::group(['prefix' => '/personal'], function () {
        Route::get('/', [EspacioPersonalController::class, 'index'])->name('table.index');
        Route::get('/{id}', [EspacioPersonalController::class, 'show'])->name('table.show');

        // Ruta para mostrar el formulario (si es necesario desde otra página, como `create.blade.php`)
        Route::get('/{id}/crear', [TareaController::class, 'create'])->name('task.create');

        // Ruta para procesar la creación de una tarea (viene del formulario en el modal)
        Route::post('/{id}', [TareaController::class, 'store'])->name('task.store');

        Route::get('/{id}/editar', [TareaController::class, 'edit'])->name('task.edit');
        Route::put('/{id}', [TareaController::class, 'update'])->name('task.update');

        Route::delete('/{id}/eliminar', [TareaController::class, 'destroy'])->name('task.destroy');
    });

    Route::group(['prefix' => '/grupal'], function () {
        Route::get('/', [EspacioGrupalController::class, 'index'])->name('grupal.index');
        Route::get('/{id}', [EspacioGrupalController::class, 'show'])->name('grupal.show');
        Route::post('/join', [EspacioGrupalController::class, 'join'])->name('grupal.join');
        Route::delete('/miembro/{id}', [EspacioGrupalController::class, 'destroymiembros'])->name('grupal.miembrodestroy');
        Route::get('/gestionar/miembros', [EspacioGrupalController::class, 'miembros'])->name('grupal.miembros');
        Route::post('/', [EspacioGrupalController::class, 'store'])->name('grupal.store');
        Route::get('/{id}/editar', [EspacioGrupalController::class, 'edit'])->name('grupal.edit');
        Route::put('/{id}', [EspacioGrupalController::class, 'update'])->name('grupal.update');
        Route::delete('/{id}', [EspacioGrupalController::class, 'destroy'])->name('grupal.destroy');
        Route::get('/create', [EspacioGrupalController::class, 'create'])->name('grupal.create');
    });
    Route::group(['prefix' => '/tareagrupal'], function () {
        // Ruta para mostrar el formulario (si es necesario desde otra página, como `create.blade.php`)
        Route::get('/{id}/crear', [TareaGrupalController::class, 'create'])->name('tareagrupal.create');

        // Ruta para procesar la creación de una tarea (viene del formulario en el modal)
        Route::post('/{id}', [TareaGrupalController::class, 'store'])->name('tareagrupal.store');

        Route::get('/{id}/editar', [TareaGrupalController::class, 'edit'])->name('tareagrupal.edit');
        Route::put('/{id}', [TareaGrupalController::class, 'update'])->name('tareagrupal.update');

        Route::delete('/{id}/eliminar', [TareaGrupalController::class, 'destroy'])->name('tareagrupal.destroy');
    });
});

//Ruta para salir en el agregar tarea

Route::get('/espaciopersonal', [EspacioPersonalController::class, 'index'])->name('espaciopersonal.index');

//Ruta para ir a la vista de administrar usuarios

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/eliminar/{id}', [AdminController::class, 'delete'])->name('admin.delete');




//hay que meterlos en un prefix todos tambien
// Route::get('/', [EspacioPersonalController::class, 'index'])->name('table.index');
// Route::get('/personal/{id}', [EspacioPersonalController::class, 'show'])->name('table.show');//modificar esos nombres

// Route::get('/personal/{id}/crear',[TareaController::class,'create'])->name('task.create');
// Route::post('personal/{id}',[TareaController::class,'store'])->name('task.store');

// Route::get('/personal/{id}/editar',[TareaController::class,'edit'])->name('task.edit');
// Route::put('/personal/{id}',[TareaController::class,'update'])->name('task.update');

// Route::delete('/personal/{id}/eliminar', [TareaController::class, 'destroy'])->name('task.destroy');

require __DIR__ . '/auth.php';
require __DIR__ . '/auth.php';
