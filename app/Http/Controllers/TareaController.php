<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;
use App\Models\TareaPersonal;
use Illuminate\Support\Facades\Auth; // Importar Auth
use Illuminate\Support\Facades\Validator;


class TareaController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        //necesito recuperar los datos del espacio personal,update : ya pude ,ajax te odio
        return view('tareas_personal.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_espacio)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciopersonal.create')->with('error', 'No estás autenticado.');
        }

        // Conversión del porcentaje
        $request['porcentaje'] = intval($request['porcentaje']);

        // Validaciones personalizadas
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:15',
            'fecha_inicio' => 'nullable|date|after_or_equal:today',
            'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio',
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
                        $fail('El porcentaje debe estar entre 70 y 99 si el estado es casi por finalizar.');
                    }

                    if ($estado === 'finalizado' && $value != 100) {
                        $fail('El porcentaje debe ser 100 si el estado es finalizado.');
                    }
                },
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no debe superar los 15 caracteres.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a la fecha actual.',
            'fecha_final.date' => 'La fecha final debe ser una fecha válida.',
            'fecha_final.after_or_equal' => 'La fecha final no puede ser anterior a la fecha de inicio.',
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        TareaPersonal::create([
            'nombre' => $request->nombre,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_final' => $request->fecha_final,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'porcentaje' => $request->porcentaje,
            'id_espacio' => $id_espacio,
        ]);

        return redirect()->route('table.index')->with('success', 'Tarea creada exitosamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tarea = TareaPersonal::findOrFail($id);

        return view('tareas_personal.edit',compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciopersonal.create')->with('error', 'No estás autenticado.');
        }

        $request['porcentaje'] = intval($request['porcentaje']);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:15',
            'fecha_inicio' => 'nullable|date|date_format:Y-m-d',
            'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio|date_format:Y-m-d',
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
                        $fail('El porcentaje debe estar entre 70 y 99 si el estado es casi por finalizar.');
                    }

                    if ($estado === 'finalizado' && $value != 100) {
                        $fail('El porcentaje debe ser 100 si el estado es finalizado.');
                    }
                },
            ],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_final.date' => 'La fecha final debe ser una fecha válida.',
            'fecha_final.after_or_equal' => 'La fecha final no puede ser anterior a la fecha de inicio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',
            'descripcion.max' => 'La descripción no debe superar los 500 caracteres.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.string' => 'El estado debe ser un texto válido.',
            'estado.in' => 'El estado debe ser uno de los valores permitidos: no iniciado, iniciado, casi por finalizar o finalizado.',
            'porcentaje.required' => 'El porcentaje es obligatorio.',
            'porcentaje.integer' => 'El porcentaje debe ser un número entero.',
            'porcentaje.min' => 'El porcentaje no puede ser menor que 0.',
            'porcentaje.max' => 'El porcentaje no puede ser mayor que 100.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tarea = TareaPersonal::findOrFail($id);
        $tarea->update($request->all());

        return redirect()->route('table.index')->with('success', 'Tarea actualizada exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciopersonal.create')->with('error', 'No estás autenticado.');
        }

        $tarea = TareaPersonal::findOrFail($id);

        $tarea->delete();
        return redirect()->route('table.index')->with('success', 'Espacio registrado exitosamente.');
    }
}
