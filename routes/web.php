<?php
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
//     return view('welcome');
// });
//ROOTES DE LOS USUARIOS
//insertar
Route::post("/insertar", [Usuarios::class, "InsertarUsuario"])->name("usuarios.insertar");
//general
Route::get('/', [Usuarios::class, 'VisualizarUsuarios'])->name('usuarios.imprimirUsers');
