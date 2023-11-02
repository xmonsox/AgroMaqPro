<?php

namespace App\Http\Controllers;
use App\Models\Repuesto;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Repuestos extends Controller
{
    //funcion para consultar y enviar los datos a la tabla en el .vue
    public function showRepuestos()
    {
        $repuesto = Repuesto::get();
        $data = [
            'status' => true,
            'repuestoData' => $repuesto
            ];
        return response()->json($data);
    }
    // Funcion para mostrar la vista de los proveedores
    public function viewRepuestos()
    {
        return view('repuestos');
    }
    public function getProveedores()
    {
        $proveedores = Supplier::get();
        $data = [
            'status'=> true,
            'proveedores'=> $proveedores
            ];
        return response()->json($data);
    }
    //funcion para hacer el registrar
    public function InsertRepuesto(Request $request)
    {
        $request->validate([
            'serial' => 'required|string|', // Verifica que el nombre sea único en la tabla 'repuestos'
            'nombre' => 'required|string|', // Verifica que el nombre sea único en la tabla 'repuestos'
            'tipo_repuesto' => 'required|string|', // Verifica que el celular sea único en la tabla 'repuestos'
            'cantidad' => 'required|int|', // Verifica que la dirección sea única en la tabla 'repuestos'
            'precio_compra' => 'required|int|', // Verifica que el email sea único en la tabla 'repuestos'
            'descripcion' => 'required|string|', // Verifica que el email sea único en la tabla 'repuestos'
            'id_proveedor' => 'required|int|', // Verifica que el email sea único en la tabla 'repuestos'
            'estado' => 'required|string|', // Verifica que el email sea único en la tabla 'repuestos'
        ]);

        // Si llegas a este punto, significa que los datos son únicos y puedes proceder a registrar el proveedor.

        $repuesto = new Repuesto;
        $repuesto->nombre = $request->input('nombre');
        $repuesto->serial = $request->input('serial');
        $repuesto->tipo_repuesto = $request->input('tipo_repuesto');
        $repuesto->cantidad = $request->input('cantidad');
        $repuesto->precio_compra = $request->input('precio_compra');
        $repuesto->descripcion = $request->input('descripcion');
        $repuesto->id_proveedor = $request->input('id_proveedor');
        $repuesto->estado = $request->input('estado');
        $repuesto->save();

        $data = [
            'status' => true,
            'repuesto' => $repuesto
        ];

        return response()->json($data);
    }
    public function updateRepuestos(Request $request, $id)
    {
        $request->validate([
            'serial' => 'required|string', // Verifica que el nombre sea único en la tabla 'repuestos'
            'nombre' => 'required|string', // Verifica que el nombre sea único en la tabla 'repuestos'
            'tipo_repuesto' => 'required|string', // Verifica que el celular sea único en la tabla 'repuestos'
            'cantidad' => 'required|int', // Verifica que la dirección sea única en la tabla 'repuestos'
            'precio_compra' => 'required|int', // Verifica que el email sea único en la tabla 'repuestos'
            'descripcion' => 'required|string', // Verifica que el email sea único en la tabla 'repuestos'
            'id_proveedor' => 'required|int', // Verifica que el email sea único en la tabla 'repuestos'
            'estado' => 'required|string', // Verifica que el email sea único en la tabla 'repuestos'
        ]);

        $repuesto = Repuesto::find($id);
        $repuesto->nombre = $request->input('nombre');
        $repuesto->serial = $request->input('serial');
        $repuesto->tipo_repuesto = $request->input('tipo_repuesto');
        $repuesto->cantidad = $request->input('cantidad');
        $repuesto->precio_compra = $request->input('precio_compra');
        $repuesto->descripcion = $request->input('descripcion');
        $repuesto->id_proveedor = $request->input('id_proveedor');
        $repuesto->estado = $request->input('estado');
        $repuesto->save();
        $data = [
            'status' => true,
            'repuesto' => $repuesto,
            'id' => $id,
            'request' => $request,
        ];
        return response()->json($data);
    }
    public function deleteRepuestos($id)
    {
        $repuesto = Repuesto::find($id);
        if (!$repuesto) {
            return response()->json(['status' => false, 'message' => 'repuesto no encontrado']);
        }

        // Realiza la eliminación del usuario
        $repuesto->delete();
        return response()->json(['status' => true, 'message' => 'repuesto eliminado con éxito']);
    }
}
