<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class Usuarios extends Controller
{
    public function VisualizarUsuarios()
    {
        $users = Usuario::get();
        $data = [
            'status' => true,
            'userData' => $users,
        ];
        return response()->json($data);
    }
    public function viewUsers()
    {
        return view('usuarios');
    }
    public function index()
    {
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
    public function updateUser(Request $request, $id)
    {
        $users = Usuario::find($id);
        $users->id = $request->input('id');
        $users->documento = $request->input('documento');
        $users->nombre = $request->input('nombre');
        $users->apellido = $request->input('apellido');
        $users->celular = $request->input('celular');
        $users->email = $request->input('email');
        $users->rol = $request->input('rol');
        $users->salario = $request->input('salario');
        // $users->contraseña = $request->input('password');
        $users->save();
        $data = [
            'status' => true,
            'users' => $users,
            'id' => $id,
            'request' => $request,
        ];
        return response()->json($data);
    }
    public function deleteUser($id)
    {
        $user = Usuario::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Usuario no encontrado']);
        }

        // Realiza la eliminación del usuario
        $user->delete();
        return response()->json(['status' => true, 'message' => 'Usuario eliminado con éxito']);
    }

}
