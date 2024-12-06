<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() //administardor de usuarios
    {
        //$user = User::where('id', auth()->id())->get();
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.index', compact('users'));
    }

    public function edit($id) //administardor de usuarios (editar)
    {
        //$user = User::where('id', auth()->id())->get();
        $users = User::findOrFail($id);



        return view('admin.edit', compact('users'));
    }

    public function update(Request $request, $id)//Actualizar los datos 
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'user_name' => 'required|string|max:15|unique:users,user_name,' . $id,
            'apellidos' => 'required|string|max:15',
            'rol' => 'required|in:0,1', 
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->apellidos = $request->apellidos;
        $user->rol = $request->rol;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function delete($id) //administardor de usuarios
    {
        //$user = User::where('id', auth()->id())->get();
        

        $user = User::with('espaciosGrupales', 'Miembrogrupal')->findOrFail($id);

        // Eliminar los espacios grupales asociados a los miembros grupales del usuario
        foreach ($user->espaciosGrupales as $espacio) {
            $espacio->delete();
        }

        // Eliminar los registros de miembros grupales
        $user->Miembrogrupal()->delete();

        // Eliminar el usuario
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Usuario y sus asociaciones eliminados exitosamente.');
    }
}
