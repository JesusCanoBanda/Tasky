<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioGrupal;
use App\Models\Miembrosgrupal;
use App\Models\TareaGrupal;
use Illuminate\Support\Facades\Auth; // Importar Auth

class EspacioGrupalController extends Controller
{
    public function index()
    {
        // ID del usuario autenticado
        $userId = Auth::id();

        // Obtener los miembros del usuario junto con sus espacios
        $miembros = Miembrosgrupal::where('id_usuario', $userId)
            ->with('espacio') // Asumimos que existe una relación 'espacio' en el modelo Miembrosgrupal
            ->get();

        // Mapear los espacios y roles asociados
        $espacios = $miembros->map(function ($miembro) {
            return [
                'espacio' => $miembro->espacio, // El espacio relacionado
                'isAdmin' => $miembro->rol == 1, // Determinar si el usuario es administrador
            ];
        });

        // Pasar los datos a la vista
        return view('espaciogrupal.index', compact('espacios'));
    }

    public function destroymiembros($id)
    {
        $miembro = Miembrosgrupal::find($id); // O lo que sea adecuado para obtener al miembro
        if ($miembro) {
            $miembro->delete(); // Elimina el miembro
            return redirect()->route('grupal.miembros')->with('success', 'Miembro eliminado correctamente.');
        } else {
            return redirect()->route('grupal.miembros')->with('error', 'Miembro no encontrado.');
        }
    }

    public function miembros()
    {
        dd('hola');
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Obtener los miembros de los espacios del usuario autenticado
        $miembros = Miembrosgrupal::where('id_usuario', $userId)
            ->with('espacio') // Obtener los espacios relacionados con los miembros
            ->get();

        // Formatear los datos para enviarlos a la vista
        $espaciosConMiembros = $miembros->map(function ($miembro) {
            return [
                'espacio' => $miembro->espacio, // El espacio relacionado
                'miembro' => $miembro, // El miembro y su rol en ese espacio
            ];
        });

        // Pasar los datos a la vista 'espaciogrupal.gestion'
        return view('espaciogrupal.gestion', compact('espaciosConMiembros'));
    }

    public function join(Request $request)
    {
        // Validar el ID del espacio
        $request->validate([
            'id_espacio' => 'required|exists:espacio_grupal,id', // Verifica si existe el espacio
        ]);

        $user = Auth::user(); // Usuario autenticado
        $idEspacio = $request->input('id_espacio');

        // Verificar si el usuario ya es miembro del espacio
        $existingMember = Miembrosgrupal::where('id_grupal', $idEspacio)
            ->where('id_usuario', $user->id)
            ->first();

        if ($existingMember) {
            return redirect()->route('grupal.index')->with('error', 'Ya eres miembro de este espacio.');
        }

        // Agregar el usuario al espacio con rol de "Miembro" (0)
        Miembrosgrupal::create([
            'id_grupal' => $idEspacio,
            'id_usuario' => $user->id,
            'rol' => 0,
        ]);

        return redirect()->route('grupal.index')->with('success', 'Te has unido al espacio exitosamente.');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        // Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // Verificar si el usuario está autenticado
        if (!$userId) {
            return redirect()->route('grupal.create')->with('error', 'No estás autenticado.');
        }

        // Crear el espacio grupal (debe ser un EspacioGrupal)
        $espacio = EspacioGrupal::create([
            'nombre' => $validatedData['nombre'],
            'categoria' => $validatedData['categoria'],
            'id_user' => $userId,
        ]);

        // Agregar al usuario como miembro del espacio grupal con rol de "admin"
        Miembrosgrupal::create([
            'id_grupal' => $espacio->id,
            'id_usuario' => $userId,
            'rol' => 1, // 1 para rol de admin, puedes ajustarlo si es necesario
        ]);

        return redirect()->route('grupal.index')->with('success', 'Espacio grupal creado exitosamente.');
    }

    public function show($id)
    {
        $espacio = EspacioGrupal::findOrFail($id);
        $miembros = $espacio->miembros;
        $tareas = TareaGrupal::where('id_espacio', $id)->get();

        // Determina si el usuario autenticado es admin en este espacio
        $isAdmin = Miembrosgrupal::where('id_grupal', $id)->where('id_usuario', Auth::id())->value('rol') == 1;

        return response()->json([
            'espacio' => $espacio,
            'miembros' => $miembros,
            'tareas' => $tareas,
            'isAdmin' => $isAdmin, // Enviar el estado del rol
        ]);
    }

    public function addMember(Request $request, $id)
    {
        // Agregar miembros a un espacio grupal
        $validatedData = $request->validate([
            'id_usuario' => 'required|exists:users,id',
            'rol' => 'required|integer',
        ]);

        // Verificar si el usuario ya está en el espacio
        $existingMember = Miembrosgrupal::where('id_grupal', $id)
            ->where('id_usuario', $validatedData['id_usuario'])
            ->first();

        if ($existingMember) {
            return redirect()->route('grupal.show', $id)->with('error', 'Este usuario ya es miembro de este espacio.');
        }

        // Agregar el nuevo miembro
        Miembrosgrupal::create([
            'id_grupal' => $id,
            'id_usuario' => $validatedData['id_usuario'],
            'rol' => $validatedData['rol'],
        ]);

        return redirect()->route('grupal.show', $id)->with('success', 'Miembro agregado exitosamente.');
    }

    public function assignTask(Request $request, $id)
    {
        // Asignar tarea grupal a un miembro
        $validatedData = $request->validate([
            'fechafinal' => 'required|date',
            'fechainicio' => 'required|date|before_or_equal:fechafinal',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'porcentaje' => 'required|integer|between:0,100',
            'categoria' => 'required|string|max:255',
            'id_usuario' => 'required|exists:users,id', // Miembro asignado
        ]);

        // Crear tarea
        TareaGrupal::create([
            'fechafinal' => $validatedData['fechafinal'],
            'fechainicio' => $validatedData['fechainicio'],
            'descripcion' => $validatedData['descripcion'],
            'estado' => $validatedData['estado'],
            'porcentaje' => $validatedData['porcentaje'],
            'categoria' => $validatedData['categoria'],
            'id_espacio' => $id,
            'responsable' => $validatedData['id_usuario'],
        ]);

        return redirect()->route('grupal.show', $id)->with('success', 'Tarea asignada exitosamente.');
    }

    public function edit($id)
    {
        // Formulario de edición
        $espacio = EspacioGrupal::findOrFail($id);
        return view('espaciogrupal.edit', compact('espacio'));
    }

    public function update(Request $request, $id)
    {
        // Actualizar un registro
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        $espacio = EspacioGrupal::findOrFail($id);
        $espacio->update($validatedData);

        return redirect()->route('grupal.index')->with('success', 'Espacio actualizado exitosamente.');
    }

    public function destroy($id)
    {
        //eliminar
        $espacio = EspacioGrupal::findOrFail($id);
        $espacio->delete();

        return redirect()->route('grupal.index')->with('success', 'Espacio registrado exitosamente.');
    }

    public function create()
    {
        // Formulario de creación
        return view('espaciogrupal.create');
    }

    public function read()
    {
        $espacios = EspacioGrupal::all();
        return view('espaciogrupal.read', compact('espacios'));
    }
}
