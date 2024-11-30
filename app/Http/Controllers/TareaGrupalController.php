<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioGrupal;
use App\Models\MiembrosGrupal;

use App\Models\TareaGrupal;
use Illuminate\Support\Facades\Auth; // Importar Auth

class TareaGrupalController extends Controller
{
    /**
     * Mostrar el formulario para crear una nueva tarea grupal.
     */
    public function create($id)
    {
        // Obtener los miembros del espacio grupal
        $miembros = MiembrosGrupal::where('id_grupal', $id)->with('usuario')->get();

        // Retornar la vista con el ID del espacio grupal y los miembros
        return view('tareas_grupal.create', compact('id', 'miembros'));
    }

    /**
     * Guardar una nueva tarea grupal en la base de datos.
     */
    public function store(Request $request, $id_espacio)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciogrupal.create')->with('error', 'No estás autenticado.');
        }

        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fechainicio' => 'nullable|date',
            'fechafinal' => 'nullable|date|after_or_equal:fechainicio',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|string|in:iniciado,completado,finalizado',
            'porcentaje' => 'required|integer|min:0|max:100',
            'responsable' => 'nullable|string|max:255',
            'categoria' => 'required|string|max:255', // Validar 'categoria'
        ]);

        TareaGrupal::create([
            'nombre' => $validateData['nombre'],
            'fechainicio' => $validateData['fechainicio'],
            'fechafinal' => $validateData['fechafinal'],
            'descripcion' => $validateData['descripcion'],
            'estado' => $validateData['estado'],
            'porcentaje' => $validateData['porcentaje'],
            'id_espacio' => $id_espacio,
            'responsable' => $validateData['responsable'] ?? null,
            'categoria' => $validateData['categoria'], // Asignar 'categoria'
        ]);

        return redirect()->route('grupal.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Mostrar el formulario para editar una tarea grupal.
     */
    public function edit($id)
    {
        $tarea = TareaGrupal::findOrFail($id);

        return view('tareas_grupal.edit', compact('tarea'));
    }

    /**
     * Actualizar una tarea grupal existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciogrupal.create')->with('error', 'No estás autenticado.');
        }

        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fechainicio' => 'nullable|date',
            'fechafinal' => 'nullable|date|after_or_equal:fechainicio',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|string|in:iniciado,completado,finalizado',
            'porcentaje' => 'required|integer|min:0|max:100',
            'responsable' => 'nullable|string|max:255',
            'categoria' => 'required|string|max:255', // Validar 'categoria'
        ]);

        $tarea = TareaGrupal::findOrFail($id);
        $tarea->update($validateData);

        return redirect()->route('grupal.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Eliminar una tarea grupal de la base de datos.
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciogrupal.create')->with('error', 'No estás autenticado.');
        }

        $tarea = TareaGrupal::findOrFail($id);

        $tarea->delete();
        return redirect()->route('grupal.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
