<?php

use App\Http\Controllers\EspacioPersonalController;
use App\Http\Controllers\EspacioGrupalController;

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
        // Ruta para listar los espacios grupales del usuario autenticado
        Route::get('/', [EspacioGrupalController::class, 'index'])->name('grupal.index');
        // Ruta para procesar la solicitud POST cuando el usuario se une a un espacio
        Route::post('/join/{id}', [EspacioGrupalController::class, 'join'])->name('espaciogrupal.join');

        // Ruta para mostrar un espacio grupal específico con tareas y miembros
        Route::get('/{id}', [EspacioGrupalController::class, 'show'])->name('grupal.show');

        // Ruta para procesar la creación de un nuevo espacio grupal
        Route::post('/', [EspacioGrupalController::class, 'store'])->name('grupal.store');

        // Ruta para mostrar el formulario para editar un espacio grupal
        Route::get('/{id}/editar', [EspacioGrupalController::class, 'edit'])->name('grupal.edit');

        // Ruta para procesar la actualización de un espacio grupal
        Route::put('/{id}', [EspacioGrupalController::class, 'update'])->name('grupal.update');

        // Ruta para eliminar un espacio grupal
        Route::delete('/{id}', [EspacioGrupalController::class, 'destroy'])->name('grupal.destroy');

        // Ruta para agregar un miembro a un espacio grupal
        Route::post('/{id}/add-member', [EspacioGrupalController::class, 'addMember'])->name('grupal.addMember');

        // Ruta para asignar una tarea grupal a un miembro
        Route::post('/{id}/assign-task', [EspacioGrupalController::class, 'assignTask'])->name('grupal.assignTask');

        // Ruta para mostrar el formulario de creación de un espacio grupal
        Route::get('/create', [EspacioGrupalController::class, 'create'])->name('grupal.create');

        // Ruta para leer todos los espacios grupales
        Route::get('/read', [EspacioGrupalController::class, 'read'])->name('grupal.read');
    });
});

//Ruta para salir en el agregar tarea

Route::get('/espaciopersonal', [EspacioPersonalController::class, 'index'])->name('espaciopersonal.index');

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
