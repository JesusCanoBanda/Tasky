<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Miembrogrupal;
use App\Models\TareaGrupal;
use Illuminate\Support\Facades\Auth; // Importar Auth

use Illuminate\Support\Facades\Validator;


class TareaGrupalController extends Controller
{
    /**
     * Mostrar el formulario para crear una nueva tarea grupal.
     */
    public function create($id)
    {
        // Obtener los miembros del espacio grupal
        $miembros = Miembrogrupal::where('id_grupal', $id)->with('usuario')->get();

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

         $request['porcentaje'] = intval($request['porcentaje']);

         $validator = Validator::make($request->all(), [
             'nombre' => 'required|string|max:20',
             'fechainicio' => 'required|date|after_or_equal:today', // Fecha requerida
             'fechafinal' => 'required|date|after_or_equal:fechainicio', // Fecha requerida
             'descripcion' => 'required|string|max:50', // Limitar a 25 caracteres
             'estado' => 'required|string|in:no iniciado,iniciado,casi por finalizar,finalizado',
             'porcentaje' => [
                 'required',
                 'integer',
                 'min:0',
                 'max:100',
                 function ($attribute, $value, $fail) use ($request) {
                     $estado = $request->input('estado');

                     if ($estado === 'no iniciado' && $value != 0) {
                         $fail('El porcentaje debe ser 0 si el estado es no iniciado.');
                     }

                     if ($estado === 'iniciado' && ($value <= 0 || $value > 70)) {
                         $fail('El porcentaje debe ser mayor a 0 y no superar el 70% si el estado es iniciado.');
                     }

                     if ($estado === 'casi por finalizar' && ($value == 100 || $value < 70)) {
                         $fail('El porcentaje no puede ser menor que 70 e igual a 100 si el estado es casi por finalizar.');
                     }

                     if ($estado === 'finalizado' && $value != 100) {
                         $fail('El porcentaje debe ser 100 si el estado es finalizado.');
                     }
                 },
             ],
             'responsable' => 'required|string|max:20', // Limitar a 15 caracteres
             'categoria' => 'required|string|max:50',   // Limitar a 25 caracteres
         ], [
             'nombre.required' => 'El nombre es obligatorio.',
             'nombre.string' => 'El nombre debe ser un texto válido.',
             'nombre.max' => 'El nombre no debe superar los 20 caracteres.',

             'fechainicio.required' => 'La fecha de inicio es obligatoria.',
             'fechainicio.date' => 'La fecha de inicio debe ser una fecha válida.',
             'fechainicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',

             'fechafinal.required' => 'La fecha final es obligatoria.',
             'fechafinal.date' => 'La fecha final debe ser una fecha válida.',
             'fechafinal.after_or_equal' => 'La fecha final no puede ser anterior a la fecha de inicio.',

             'descripcion.required' => 'La descripción es obligatoria.',
             'descripcion.string' => 'La descripción debe ser un texto válido.',
             'descripcion.max' => 'La descripción no debe superar los 50 caracteres.',

             'estado.required' => 'El estado es obligatorio.',
             'estado.string' => 'El estado debe ser un texto válido.',
             'estado.in' => 'El estado debe ser uno de los valores permitidos: no iniciado, iniciado, casi por finalizar o finalizado.',

             'porcentaje.required' => 'El porcentaje es obligatorio.',
             'porcentaje.integer' => 'El porcentaje debe ser un número entero.',
             'porcentaje.min' => 'El porcentaje no puede ser menor que 0.',
             'porcentaje.max' => 'El porcentaje no puede ser mayor que 100.',

             'responsable.required' => 'El responsable es obligatorio.',
             'responsable.string' => 'El responsable debe ser un texto válido.',
             'responsable.max' => 'El responsable no debe superar los 15 caracteres.',

             'categoria.required' => 'Las notas son obligatorias.',
             'categoria.string' => 'Las notas deben ser un texto válido.',
             'categoria.max' => 'Las notas no deben superar los 50 caracteres.',
         ]);

         if ($validator->fails()) {
             return redirect()->back()
                 ->withErrors($validator)
                 ->withInput();
         }

         TareaGrupal::create([
             'nombre' => $request->nombre,
             'fechainicio' => $request->fechainicio,
             'fechafinal' => $request->fechafinal,
             'descripcion' => $request->descripcion,
             'estado' => $request->estado,
             'porcentaje' => $request->porcentaje,
             'id_espacio' => $id_espacio,
             'responsable' => $request->responsable,
             'categoria' => $request->categoria,
         ]);

         return redirect()->route('grupal.index')->with('success', 'Tarea creada exitosamente.');
     }



    /**
     * Mostrar el formulario para editar una tarea grupal.
     */
    public function edit($id)
    {
        $tarea = TareaGrupal::findOrFail($id);
        $miembros = Miembrogrupal::where('id_grupal', $tarea->id_espacio)->with('usuario')->get();

        return view('tareas_grupal.edit', compact('tarea','miembros'));
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

    $request['porcentaje'] = intval($request['porcentaje']);

    $validator = Validator::make($request->all(), [
        'nombre' => 'required|string|max:20',
        'fechainicio' => 'required|date',
        'fechafinal' => 'required|date|after_or_equal:fechainicio',
        'descripcion' => 'required|string|max:50',
        'estado' => 'required|string|in:no iniciado,iniciado,casi por finalizar,finalizado',
        'porcentaje' => [
            'required',
            'integer',
            'min:0',
            'max:100',
            function ($attribute, $value, $fail) use ($request) {
                $estado = $request->input('estado');

                if ($estado === 'no iniciado' && $value != 0) {
                    $fail('El porcentaje debe ser 0 si el estado es no iniciado.');
                }

                if ($estado === 'iniciado' && ($value <= 0 || $value > 70)) {
                    $fail('El porcentaje debe ser mayor a 0 y no superar el 70% si el estado es iniciado.');
                }

                if ($estado === 'casi por finalizar' && ($value == 100 || $value < 70)) {
                    $fail('El porcentaje no puede ser menor que 70 ni igual a 100 si el estado es casi por finalizar.');
                }

                if ($estado === 'finalizado' && $value != 100) {
                    $fail('El porcentaje debe ser 100 si el estado es finalizado.');
                }
            },
        ],
        'responsable' => 'required|string|max:20',
        'categoria' => 'required|string|max:50',
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.string' => 'El nombre debe ser un texto válido.',
        'nombre.max' => 'El nombre no debe superar los 20 caracteres.',

        'fechainicio.required' => 'La fecha de inicio es obligatoria.',
        'fechainicio.date' => 'La fecha de inicio debe ser una fecha válida.',
        'fechafinal.required' => 'La fecha final es obligatoria.',
        'fechafinal.date' => 'La fecha final debe ser una fecha válida.',
        'fechafinal.after_or_equal' => 'La fecha final debe ser posterior o igual a la fecha de inicio.',

        'descripcion.required' => 'La descripción es obligatoria.',
        'descripcion.string' => 'La descripción debe ser un texto válido.',
        'descripcion.max' => 'La descripción no debe superar los 50 caracteres.',

        'estado.required' => 'El estado es obligatorio.',
        'estado.string' => 'El estado debe ser un texto válido.',
        'estado.in' => 'El estado debe ser uno de los valores permitidos: no iniciado, iniciado, casi por finalizar o finalizado.',

        'porcentaje.required' => 'El porcentaje es obligatorio.',
        'porcentaje.integer' => 'El porcentaje debe ser un número entero.',
        'porcentaje.min' => 'El porcentaje no puede ser menor que 0.',
        'porcentaje.max' => 'El porcentaje no puede ser mayor que 100.',

        'responsable.required' => 'El responsable es obligatorio.',
        'responsable.string' => 'El responsable debe ser un texto válido.',
        'responsable.max' => 'El responsable no debe superar los 15 caracteres.',

        'categoria.required' => 'Las notas son obligatorias.',
        'categoria.string' => 'Las notas debe ser un texto válido.',
        'categoria.max' => 'Las notas no deben superar los 50 caracteres.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $tarea = TareaGrupal::findOrFail($id);
    $tarea->update($validator->validated());

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
