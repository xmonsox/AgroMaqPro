<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machinery;

class MachineryController extends Controller
{
    public function viewMachinery(){
        return view("machinery");
    }
    public function showMachinery(){
        $machinery = Machinery::get();
        $data = [
            'status' => true,
            'machineryData' => $machinery
            ];
        return response()->json($data);
    }
    public function InsertMachinery(Request $request)
    {
        // $request->validate([
        //     'nombre' => 'required|string|unique:machineries', // Verifica que el nombre sea único en la tabla 'machineries'
        //     'matricula' => 'required|string|unique:machineries', // Verifica que el celular sea único en la tabla 'machineries'
        //     'cantidad' => 'required|string|unique:machineries', // Verifica que la dirección sea única en la tabla 'machineries'
        //     'email' => 'required|email|unique:machineries', // Verifica que el email sea único en la tabla 'machineries'
        // ]);

        // Si llegas a este punto, significa que los datos son únicos y puedes proceder a registrar el proveedor.

        $machinery = new Machinery;
        $machinery->matricula = $request->input('matricula');
        $machinery->nombre = $request->input('nombre');
        $machinery->cantidad = $request->input('cantidad');
        $machinery->tipo_maquinaria = $request->input('tipo_maquinaria');
        $machinery->estado = $request->input('estado');
        $machinery->save();
        $machinery = machinery::get();
        $data = [
            'status' => true,
            'machineryData' => $machinery
            ];
        return response()->json($data);

        // $data = [
        //     'status' => true,
        //     'supplier' => $supplier
        // ];

        // return response()->json($data);
    }
    public function updateMachinery(Request $request, $id)
    {
        // $request->validate([
        //     'nombre' => 'required|string',
        //     'telefono' => 'required|string',
        //     'direccion' => 'required|string',
        //     'email' => 'required|email',
        // ]);

        $machinery = Machinery::find($id);
        $machinery->matricula = $request->input('matricula');
        $machinery->nombre = $request->input('nombre');
        $machinery->cantidad = $request->input('cantidad');
        $machinery->tipo_maquinaria = $request->input('tipo_maquinaria');
        $machinery->estado = $request->input('estado');
        $machinery->save();
        $machinery = machinery::get();
        $data = [
            'status' => true,
            'machineryData' => $machinery
            ];
        return response()->json($data);
        // $data = [
        //     'status' => true,
        //     'supplier' => $supplier,
        //     'id' => $id,
        //     'request' => $request,
        // ];
        // return response()->json($data);

        $machinery = Machinery::get();
        $data = [
            'status' => true,
            'machineryData' => $machinery
            ];
        return response()->json($data);
    }
    public function deleteMachinery($id)
    {
        $machinery = Machinery::find($id);
        if (!$machinery) {
            return response()->json(['status' => false, 'message' => 'Supplier no encontrado']);
        }

        // Realiza la eliminación del usuario
        $machinery->delete();
        return response()->json(['status' => true, 'message' => 'Supplier eliminado con éxito']);
        $machinery = Machinery::get();
        $data = [
            'status' => true,
            'machineryData' => $machinery
            ];
        return response()->json($data);
    }
}
