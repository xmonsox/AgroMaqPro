<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;

class Usuarios extends Controller
{
    public function VisualizarUsuarios(){
        $users = Usuario::get();
        $data = [
            'status'=> true,
            'userData'=> $users,
        ];
        return response()->json($data);
    }
    public function viewUsers(){
        return view('usuarios');
    }
    public function index(){
        return view('ViewDefault');
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
        $users->contraseña = $request->input('password');
        $users->save();

        $data = [
            'status' => true,
            'users' => $users
        ];
        return response()->json($request);
    }
}
