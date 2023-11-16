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
        $request->validate([
            'nombre' => 'required|string|unique:suppliers', // Verifica que el nombre sea único en la tabla 'suppliers'
            'telefono' => 'required|string|unique:suppliers', // Verifica que el celular sea único en la tabla 'suppliers'
            'direccion' => 'required|string|unique:suppliers', // Verifica que la dirección sea única en la tabla 'suppliers'
            'email' => 'required|email|unique:suppliers', // Verifica que el email sea único en la tabla 'suppliers'
        ]);

        // Si llegas a este punto, significa que los datos son únicos y puedes proceder a registrar el proveedor.

        $supplier = new Supplier;
        $supplier->nombre = $request->input('nombre');
        $supplier->telefono = $request->input('telefono');
        $supplier->direccion = $request->input('direccion');
        $supplier->email = $request->input('email');
        $supplier->save();
        $suppliers = Supplier::get();
        $data = [
            'status' => true,
            'supplierData' => $suppliers
            ];
        return response()->json($data);

        // $data = [
        //     'status' => true,
        //     'supplier' => $supplier
        // ];

        // return response()->json($data);
    }
}
