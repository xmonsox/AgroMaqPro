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
Route::get("", [Usuarios::class, 'index']);;
//insertar
Route::post("/registerUser", [Usuarios::class, "InsertarUsuario"])->name("usuarios.insertar");
//general
Route::get('/User/usuariosShow', [Usuarios::class, 'VisualizarUsuarios'])->name("usuarios.imprimirUsers");

Route::get('/ViewUsers', [Usuarios::class, 'viewUsers'])->name("viewUsers");
