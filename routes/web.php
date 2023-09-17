<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\SubcripcionControler;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserController;
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
//     // return view('welcome');
//     return view('home.inicio');

// });

Route::get('/', [HomeController::class, 'index']);

// PRODUCTOS
Route::post('/producto/ajaxListado', [ProductoController::class, 'ajaxListado']);
Route::get('/producto/listado', [ProductoController::class, 'listado']);
Route::post('/producto/guarda', [ProductoController::class, 'guarda']);
Route::post('/producto/cambiaEstado', [ProductoController::class, 'cambiaEstado']);
Route::post('/producto/eliminar', [ProductoController::class, 'eliminar']);
Route::post('/producto/verificaPlan', [ProductoController::class, 'verificaPlan']);

// CATEGORIAS
Route::post('/categoria/ajaxListado', [CategoriaController::class, 'ajaxListado']);
Route::get('/categoria/listado', [CategoriaController::class, 'listado']);
Route::post('/categoria/guarda', [CategoriaController::class, 'guarda']);
Route::post('/categoria/elimina', [CategoriaController::class, 'elimina']);
Route::post('/categoria/buscaSubCategorias', [CategoriaController::class, 'buscaSubCategorias']);

// SUB CATEGORIAS
Route::post('/subcategoria/ajaxListado', [SubCategoriaController::class, 'ajaxListado']);
Route::get('/subcategoria/listado', [SubCategoriaController::class, 'listado']);
Route::post('/subcategoria/guarda', [SubCategoriaController::class, 'guarda']);
Route::post('/subcategoria/elimina', [SubCategoriaController::class, 'elimina']);

// TIENDA
Route::post('/tienda/ajaxListado', [TiendaController::class, 'ajaxListado']);
Route::get('/tienda/listado', [TiendaController::class, 'listado']);
Route::post('/tienda/guarda', [TiendaController::class, 'guarda']);
Route::post('/tienda/elimina', [TiendaController::class, 'elimina']);
Route::get('/tienda/perfil', [TiendaController::class, 'perfil']);
Route::post('/tienda/detallePerfil', [TiendaController::class, 'detallePerfil']);
Route::post('/tienda/enviarCorreo', [TiendaController::class, 'enviarCorreo']);
Route::post('/tienda/guardaAdmin', [TiendaController::class, 'guardaAdmin']);
Route::post('/tienda/cambiaEstadoTienda', [TiendaController::class, 'cambiaEstadoTienda']);
Route::post('/tienda/cambiaSuscripcion', [TiendaController::class, 'cambiaSuscripcion']);
Route::post('/tienda/cambiaSuscripcionAdmin', [TiendaController::class, 'cambiaSuscripcionAdmin']);
Route::post('/tienda/buscarDepartamentos', [TiendaController::class, 'buscarDepartamentos']);
Route::post('/tienda/verificaPedidos', [TiendaController::class, 'verificaPedidos']);

// VENDEDOR
Route::get('/vendedor/inicio', [VendedorController::class, 'index']);
Route::get('/vendedor/pedido', [VendedorController::class, 'pedido']);
Route::post('/vendedor/ajaxListadoPedido', [VendedorController::class, 'ajaxListadoPedido']);
Route::post('/vendedor/cambiaEstado', [VendedorController::class, 'cambiaEstado']);

// SUBCRIPCION
Route::get('/subcripcion/subcripcion', [SubcripcionControler::class, 'subcripcion']);
Route::get('/subcripcion/nuevoCorreo', [SubcripcionControler::class, 'nuevoCorreo']);

// INFORMACION
Route::get('/informacion/perfil', [InformacionController::class, 'perfil']);
Route::post('/informacion/guarda', [InformacionController::class, 'guarda']);

// PERSONA / COMPRADOR
Route::get('/persona/perfil', [PersonaController::class, 'perfil']);
Route::get('/persona/pedido', [PersonaController::class, 'pedido']);
Route::post('/persona/guarda', [PersonaController::class, 'guarda']);
Route::post('/persona/califica', [PersonaController::class, 'califica']);

// LOGIN
Route::get('/login', [LoginController::class, 'login']);
Route::post('/login/ingresa', [LoginController::class, 'ingresa']);
Route::get('/login/ingresaDennis', [LoginController::class, 'ingresaDennis']);
Route::get('/login/cerrar', [LoginController::class, 'cerrar']);
Route::get('/login/cambiaRol', [LoginController::class, 'cambiaRol']);
Route::get('/login/migraPaisDepàrtameto', [LoginController::class, 'migraPaisDepàrtameto']);
Route::get('/login/enviarCorreo/{html}', [LoginController::class, 'enviarCorreo']);
Route::get('/login/enviCo', [LoginController::class, 'enviCo']);
// Route::get('/login/volver', function () {
//     return redirect()->to('https://www.otro-dominio.com');
// });

// USUARIO
Route::get('/users', [UserController::class, 'listado']);
Route::post('/users/guarda', [UserController::class, 'guarda']);
Route::post('/users/eliminar', [UserController::class, 'eliminar']);
Route::post('/users/cambiarEstadoPerfil', [UserController::class, 'cambiarEstadoPerfil']);

// // EXTERNOS
// Route::post('/enviarcorreo', [CorreoController::class, 'enviarCorreo']);


