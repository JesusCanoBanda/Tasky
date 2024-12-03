<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;
use Illuminate\Support\Facades\Auth; // Importar Auth

class EspacioPersonalController extends Controller
{
    public function index() //espacios de trabajo asociados a un usuario
    {
        $espacios = EspacioPersonal::where('id_user', auth()->id())->get();

        return view('espaciopersonal.index', compact('espacios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:18',
            'categoria' => 'required|string|max:25',
        ], [
            'nombre.max' => 'El nombre no puede tener más de 18 caracteres.',
            'categoria.max' => 'La categoría no puede tener más de 25 caracteres.',
        ]);

        $userId = Auth::id(); //aut del user

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

    public function show($id) //este es pa mostrar ya con las tareas
    {
        $espacio = EspacioPersonal::where('id', $id)->where('id_user', auth()->id())->firstOrFail();

        $tareas = EspacioPersonal::findOrFail($id)->tareas;

        return response()->json([
            'espacio' => $espacio,
            'tareas' => $tareas
        ]);
    }


    public function edit($id)//form de editar
    {
        $espacio = EspacioPersonal::findOrFail($id);
        return view('espaciopersonal.edit', compact('espacio'));
    }

    public function update(Request $request, $id)//actualizar un registro
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:18',
            'categoria' => 'required|string|max:25',
        ]);

        $espacio = EspacioPersonal::findOrFail($id);
        $espacio->update($validatedData);

        return redirect()->route('table.index')->with('success', 'Espacio registrado exitosamente.');
    }

    public function destroy($id)//eliminar
    {
        $espacio = EspacioPersonal::findOrFail($id);
        $espacio->delete();

        return redirect()->route('table.index')->with('success', 'Espacio registrado exitosamente.');
    }

    public function create()//form de creacion
    {
        return view('espaciopersonal.create');
    }

    public function read()
    {
        $espacios = EspacioPersonal::all();

        return view('espaciopersonal.read', compact('espacios'));
    }
}
