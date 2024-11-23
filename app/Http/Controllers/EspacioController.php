<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\espacio;

class EspacioController extends Controller
{
    public function dashboard(){//este va a ser el nuevo index
        return view("espacio.dashboard");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_espacio' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'deporte_id' => 'required|exists:deportes,id'
        ]);

        espacio::create([
            'nombre_espacio' => $request->nombre_espacio,
            'ubicacion' => $request->ubicacion,
            'id_deporte' => $request->deporte_id,
        ]);

        return redirect()->route('espacio.create')->with('success', 'espacio registrado exitosamente');
    }


     public function edit($id)
     {
         $espacio = espacio::findOrFail($id);
         return view('espacio.edit', compact('espacio'));
     }

     public function update(Request $request, $id)
     {
         $request->validate([
            'nombre_espacio' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
         ]);

         $espacio = espacio::findOrFail($id);
         $espacio->update([
            'nombre_espacio' => $request->nombre_espacio,
            'ubicacion' => $request->ubicacion,
         ]);

         return redirect()->route('espacio.read')->with('success', 'espacio actualizado con éxito');
     }

     public function destroy($id)
     {
         $espacio = espacio::findOrFail($id);
         $espacio->delete();
         return redirect()->route('espacio.read')->with('success', 'espacio eliminado con éxito');
     }

     public function create()
     {
         $espacio = espacio::all();
         return view('espacio.create', ['espacio' => $espacio]);
     }

    public function read()
    {
        $espacioes = espacio::all();

        return view('espacio.read', compact('espacioes'));
    }
}
