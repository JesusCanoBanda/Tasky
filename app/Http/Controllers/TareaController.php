<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;
use App\Models\TareaPersonal;

class TareaController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
