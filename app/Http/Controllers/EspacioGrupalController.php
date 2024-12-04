<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioGrupal;
use App\Models\Miembrogrupal;
use App\Models\TareaGrupal;
use Illuminate\Support\Facades\Auth; // Importar Auth

class EspacioGrupalController extends Controller
{
    public function index()
    {
        // ID del usuario autenticado
        $userId = Auth::id();

        // Obtener los miembros del usuario junto con sus espacios
        $miembros = Miembrogrupal::where('id_usuario', $userId)
            ->with('espacio') // Asumimos que existe una relación 'espacio' en el modelo Miembrogrupal
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

    public function miembros()
    {
        $userId = Auth::id();

        // Verifica que el usuario sea administrador en algún espacio grupal
        $esAdmin = Miembrogrupal::where('id_usuario', $userId)->where('rol', 1)->exists();

        if (!$esAdmin) {
            return redirect()->route('grupal.index')->with('error', 'No tienes permiso para acceder a la gestión de espacios grupales.');
        }

        // Obtén los miembros con rol 0 en los espacios grupales donde el usuario es administrador
        $miembros = Miembrogrupal::whereHas('espacio', function ($query) use ($userId) {
            $query->whereHas('miembros', function ($q) use ($userId) {
                $q->where('id_usuario', $userId)->where('rol', 1);
            });
        })
            ->where('rol', 0)
            ->with(['espacio', 'usuario'])
            ->get();

        // Formatea los datos para la vista
        $espaciosConMiembros = $miembros->map(function ($miembro) {
            return [
                'espacio' => $miembro->espacio, // Relación con EspacioGrupal
                'miembro' => $miembro, // Información del miembro
            ];
        });

        return view('espaciogrupal.gestion', compact('espaciosConMiembros'));
    }

    /**
     * Elimina la relación de un miembro con un grupo, si el usuario autenticado es administrador.
     */
    public function destroymiembros($id)
    {
        // Obtener el miembro por su ID
        $miembro = Miembrogrupal::find($id);

        if (!$miembro) {
            return redirect()->route('grupal.miembros')->with('error', 'Miembro no encontrado.');
        }

        // Verificar si el usuario autenticado es administrador del grupo
        $usuarioAutenticado = Auth::user();

        $esAdmin = Miembrogrupal::where('id_grupal', $miembro->id_grupal)
            ->where('id_usuario', $usuarioAutenticado->id)
            ->where('rol', 1)
            ->exists();

        if (!$esAdmin) {
            return redirect()->route('grupal.miembros')->with('error', 'No tienes permiso para eliminar miembros de este grupo.');
        }

        // Verificar si el miembro tiene rol 0 (es un miembro regular)
        if ($miembro->rol != 0) {
            return redirect()->route('grupal.miembros')->with('error', 'No puedes eliminar a otro administrador.');
        }

        // Eliminar la relación
        $miembro->delete();

        return redirect()->route('grupal.miembros')->with('success', 'El miembro fue eliminado correctamente del grupo.');
    }

    public function join(Request $request)
    {
        // Validar si el ID del espacio existe
        $request->validate([
            'id_espacio' => 'required|integer',
        ]);

        $idEspacio = $request->input('id_espacio');

    //     // Verificar si el espacio grupal existe
        $espacio = EspacioGrupal::find($idEspacio);

        if (!$espacio) {
            return redirect()
                ->route('grupal.index')
                ->withErrors(['id_espacio' => 'El espacio grupal no existe.']);
        }

        $user = Auth::user();

    //     // Verificar si el usuario ya es miembro del espacio
        $existingMember = Miembrogrupal::where('id_grupal', $idEspacio)
        ->where('id_usuario', $user->id)
        ->first();

        if ($existingMember) {
            return redirect()
                ->route('grupal.index')
                ->withErrors(['id_espacio' => 'Ya eres miembro de este espacio grupal.']);
        }

        // Agregar el usuario al espacio con rol de "Miembro" (0)
        Miembrogrupal::create([
            'id_grupal' => $idEspacio,
            'id_usuario' => $user->id,
            'rol' => 0,
        ]);

        return redirect()->route('grupal.index');
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:18',
            'categoria' => 'required|string|max:25',
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
        Miembrogrupal::create([
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
        $isAdmin = Miembrogrupal::where('id_grupal', $id)->where('id_usuario', Auth::id())->value('rol') == 1;

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
        $existingMember = Miembrogrupal::where('id_grupal', $id)
            ->where('id_usuario', $validatedData['id_usuario'])
            ->first();

        if ($existingMember) {
            return redirect()->route('grupal.show', $id)->with('error', 'Este usuario ya es miembro de este espacio.');
        }

        // Agregar el nuevo miembro
        Miembrogrupal::create([
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
            'nombre' => 'required|string|max:18',
            'categoria' => 'required|string|max:25',
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
