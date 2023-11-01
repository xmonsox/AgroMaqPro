<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Suppliers extends Controller
{
    //funcion para consultar y enviar los datos a la tabla en el .vue
    public function showSupplier()
    {
        $suppliers = Supplier::get();
        $data = [
            'status' => true,
            'supplierData' => $suppliers
            ];
        return response()->json($data);
    }
    // Funcion para mostrar la vista de los proveedores
    public function viewSuppliers()
    {
        return view('suppliers');
    }
    //Vista de inicio por default
    public function index()
    {
        return view('ViewDefault');
    }

    //funcion para hacer el registrar
    public function InsertSupplier(Request $request)
{
    $request->validate([
        'nombre' => 'required|string',
        'celular' => 'required|string',
        'direccion' => 'required|string',
        'email' => 'required|email',
    ]);

    $supplier = new Supplier;
    $supplier->nombre = $request->input('nombre');
    $supplier->telefono = $request->input('celular');
    $supplier->direccion = $request->input('direccion');
    $supplier->email = $request->input('email');
    $supplier->save();

    $data = [
        'status' => true,
        'supplier' => $supplier
    ];

    return response()->json($data);
}
}
