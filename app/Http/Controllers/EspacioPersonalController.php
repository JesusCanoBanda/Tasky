<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;
use Illuminate\Support\Facades\Auth; // Importar Auth

class EspacioPersonalController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        // Verificar si el usuario está autenticado
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciopersonal.create')->with('error', 'No estás autenticado.');
        }

        // Crear el registro con el ID del usuario autenticado
        EspacioPersonal::create([
            'nombre' => $validatedData['nombre'],
            'categoria' => $validatedData['categoria'],
            'id_user' => $userId, // Asegúrate de que el valor de id_user sea válido
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('table.index')->with('success', 'Espacio registrado exitosamente.');
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        // Buscar el registro por ID
        $espacio = EspacioPersonal::findOrFail($id);
        // ! aqui tiene que ir la de table con los epsacio compact
        return view('espaciopersonal.edit', compact('espacio'));
    }

    // Método para actualizar un registro existente
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        // Buscar el registro y actualizarlo
        $espacio = EspacioPersonal::findOrFail($id);
        $espacio->update($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('espaciopersonal.read')->with('success', 'Espacio actualizado correctamente.');
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        // Buscar el registro y eliminarlo
        $espacio = EspacioPersonal::findOrFail($id);
        $espacio->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('table.index')->with('success', 'Espacio registrado exitosamente.');
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        // Retornar la vista de creación
        return view('espaciopersonal.create');
    }

    // Método para leer y mostrar todos los registros
    public function read()
    {
        // Obtener todos los registros
        $espacios = EspacioPersonal::all();

        // Retornar la vista con los registros
        return view('espaciopersonal.read', compact('espacios'));
    }
}
