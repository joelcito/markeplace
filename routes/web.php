<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\SubcripcionControler;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\PersonaController;
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

// VENDEDOR
Route::get('/vendedor/inicio', [VendedorController::class, 'index']);

// SUBCRIPCION
Route::get('/subcripcion/subcripcion', [SubcripcionControler::class, 'subcripcion']);

// INFORMACION
Route::get('/informacion/perfil', [InformacionController::class, 'perfil']);
Route::post('/informacion/guarda', [InformacionController::class, 'guarda']);


// COMPRADOR
Route::get('/persona/perfil', [PersonaController::class, 'perfil']);
Route::get('/persona/pedido', [PersonaController::class, 'pedido']);

// // EXTERNOS
// Route::post('/enviarcorreo', [CorreoController::class, 'enviarCorreo']);


