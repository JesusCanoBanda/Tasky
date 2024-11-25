<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;

class TableController extends Controller
{
    /**
     * Mostrar todos los espacios en una tabla.
     */
    public function index()
    {
        // Obtener los espacios de trabajo del usuario autenticado
        $espacios = EspacioPersonal::where('id_user', auth()->id())->get();

        // Pasar los espacios a la vista
        return view('table.index', compact('espacios'));
    }

    /**
     * Mostrar la vista de un espacio específico.
     */
    public function show($id)
    {
        $espacio = EspacioPersonal::where('id', $id)->where('id_user', auth()->id())->firstOrFail();

        // Retornar los datos del espacio en formato JSON
        return response()->json($espacio);
    }
}
