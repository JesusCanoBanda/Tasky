<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;
use App\Models\TareaPersonal;
use Illuminate\Support\Facades\Auth; // Importar Auth


class TareaController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        //necesito recuperar los datos del espacio personal,update : ya pude ajax te odio
        return view('tareas_personal.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id_espacio)
    {
        // dd($id_espacio);
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('espaciopersonal.create')->with('error', 'No estás autenticado.');
        }
    
        $validateData = $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_final' => 'nullable|date|after_or_equal:fecha_inicio',
            'descripcion' => 'required|string|max:500',
            'estado' => 'required|string|in:iniciado,completado,finalizado',
            'porcentaje' => 'required|integer|min:0|max:100',
        ]);
    
        TareaPersonal::create([
            'nombre' => $validateData['nombre'],
            'fecha_inicio' => $validateData['fecha_inicio'],
            'fecha_final' => $validateData['fecha_final'],
            'descripcion' => $validateData['descripcion'],
            'estado' => $validateData['estado'],
            'porcentaje' => $validateData['porcentaje'],
            'id_espacio'=>$id_espacio        
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
        // dd($request->all());

        $validateData = $request->validate([
            'nombre'=>'required|string|max:255',
            'descripcion'=>'required|string|max:255'
        ]);

        $tarea = TareaPersonal::findOrFail($id);
        $tarea->update($validateData);

        return redirect()->route('table.index')->with('success', 'Espacio registrado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
