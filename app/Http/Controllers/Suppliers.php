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

    public function updateSuppliers(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
        ]);

        $supplier = Supplier::find($id);
        $supplier->id = $request->input('id');
        $supplier->nombre = $request->input('nombre');
        $supplier->telefono = $request->input('telefono');
        $supplier->direccion = $request->input('direccion');
        $supplier->email = $request->input('email');
        // $supplier->contraseña = $request->input('password');
        $supplier->save();
        // $data = [
        //     'status' => true,
        //     'supplier' => $supplier,
        //     'id' => $id,
        //     'request' => $request,
        // ];
        // return response()->json($data);

        $suppliers = Supplier::get();
        $data = [
            'status' => true,
            'supplierData' => $suppliers
            ];
        return response()->json($data);
    }
    public function deleteSuppliers($id)
    {
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return response()->json(['status' => false, 'message' => 'Supplier no encontrado']);
        }

        // Realiza la eliminación del usuario
        $supplier->delete();
        return response()->json(['status' => true, 'message' => 'Supplier eliminado con éxito']);
        $suppliers = Supplier::get();
        $data = [
            'status' => true,
            'supplierData' => $suppliers
            ];
        return response()->json($data);
    }
}
