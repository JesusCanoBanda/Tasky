<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EspacioPersonal;

class TableController extends Controller
{
    public function index()
    {
        // Obtener los espacios de trabajo del usuario autenticado
        $espacios = EspacioPersonal::where('id_user', auth()->id())->get();

        // Pasar los espacios a la vista
        return view('table.index', compact('espacios'));
    }


}
