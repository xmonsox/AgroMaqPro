<?php
use App\Http\Controllers\Suppliers;
use App\Http\Controllers\MachineryController;
use App\Http\Controllers\Repuestos;
use App\Http\Controllers\Usuarios;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('ViewDefault');
// });
//ROOTES DE LOS USUARIOS
Route::get("/", [Usuarios::class, 'index'])->name("Inicio");
//insertar
Route::post("/registerUser", [Usuarios::class, "InsertarUsuario"])->name("usuarios.insertar");
//general
Route::get('/User/usuariosShow', [Usuarios::class, 'VisualizarUsuarios'])->name("usuarios.imprimirUsers");
//VerUsuarios
Route::get('/ViewUsers', [Usuarios::class, 'viewUsers'])->name("viewUsers");
// editar
Route::put("/Users/UpdateUsers/{id}", [Usuarios::class, 'updateUser'])->name('updateUser');
//eliminar
Route::delete("/Users/DeleteUser/{id}", [Usuarios::class, 'deleteUser'])->name('deleteUser');

//ROUTES DE LOS PROVEEDORES
//general
Route::get('/Suppliers/SuppliersShow', [Suppliers::class, 'showSupplier'])->name("Suppliers");
//VerProveedores
Route::get('/ViewSuppliers', [Suppliers::class, 'viewSuppliers'])->name("viewSupp");
//RegistrarProveedores
Route::post("/registerSupplier", [Suppliers::class, "InsertSupplier"])->name("insertSupplier");
// editarProveedor
Route::put("/Suppliers/UpdateSuppliers/{id}", [Suppliers::class, 'updateSuppliers'])->name('updateSuppliers');
//eliminar
Route::delete("/Suppliers/DeleteSuppliers/{id}", [Suppliers::class, 'deleteSuppliers'])->name('deleteSuppliers');

//ROUTES DE LOS PROVEEDORES
//general
Route::get('/Repuestos/RepuestosShow', [Repuestos::class, 'showRepuestos'])->name("Repuestos");
// VerProveedores
Route::get('/ViewRepuestos', [Repuestos::class, 'viewRepuestos'])->name("viewRepuestos");
//consulta para traer proveedores
Route::get('/TraerProveedores', [Repuestos::class, 'getProveedores']);
//RegistrarProveedores
Route::post("/registerRepuesto", [Repuestos::class, "InsertRepuesto"])->name("insertRepuesto");
// editarProveedor
Route::put("/Repuestos/UpdateRepuestos/{id}", [Repuestos::class, 'updateRepuestos'])->name('updateRepuestos');
//eliminar
Route::delete("/Repuestos/DeleteRepuestos/{id}", [Repuestos::class, 'deleteRepuestos'])->name('deleteRepuestos');

//ROUTES DE LA MAQUINARIA
//general
Route::get('/Machinery/MachineryShow', [MachineryController::class, 'showMachinery'])->name("Machinery");
// VerProveedores
Route::get('/ViewMachinery', [MachineryController::class, 'viewMachinery'])->name("ViewMachinery");
//consulta para traer proveedores
// Route::get('/GetMachinery', [MachineryController::class, 'getMachinery']);
//RegistrarProveedores
Route::post("/registerMachinery", [MachineryController::class, "InsertMachinery"])->name("insertMachinery");
// editarProveedor
Route::put("/Machinery/UpdateMachinery/{id}", [MachineryController::class, 'updateMachinery'])->name('updateMachinery');
//eliminar
Route::delete("/Machinery/DeleteMachinery/{id}", [MachineryController::class, 'deleteMachinery'])->name('deleteMachinery');
