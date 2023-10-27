<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;

class Usuarios extends Controller
{
    public function VisualizarUsuarios(){
        $users = Usuario::get();
        return view('usuarios', ['users' => $users]);
    }

    public function InsertarUsuario(Request $request)
    {
        $users = new Usuario;
        $users->documento = $request->input('documento');
        $users->nombre = $request->input('nombre');
        $users->apellido = $request->input('apellido');
        $users->celular = $request->input('celular');
        $users->email = $request->input('email');
        $users->rol = $request->input('rol');
        $users->salario = $request->input('salario');
        $users->contraseña = $request->input('contraseña');
        $users->save();
        // return response()->json(['message' => 'Operación exitosa']);
        return redirect()->route('usuarios.index');
    }
}
