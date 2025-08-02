<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TamalController;
use App\Http\Controllers\usuariosController;
use Illuminate\Support\Facades\Route;

//Login
//Route::post('login', [usuariosController::class, 'login']);
Route::post('login', [LoginController::class, 'login']);

//Usuarios
Route::post('usuarios', [usuariosController::class, 'list']);
Route::get('usuario/{id}', [usuariosController::class, 'index']);
Route::post('usuario/roles', [usuariosController::class, 'roles']);
Route::post('usuario/nuevo', [usuariosController::class, 'store']);
Route::post('usuario/eliminar', [usuariosController::class, 'destroy']);

//Proveedores
Route::post('proveedores', [ProveedorController::class, 'list']);
Route::get('proveedor/{id}', [ProveedorController::class, 'index']);
Route::post('proveedor/nuevo', [ProveedorController::class, 'store']);
Route::post('proveedor/eliminar', [ProveedorController::class, 'destroy']);

//Producto
Route::post('productos', [ProductoController::class, 'list']);
Route::get('producto/{id}', [ProductoController::class, 'index']);
Route::post('producto/nuevo', [ProductoController::class, 'store']);
Route::post('producto/eliminar', [ProductoController::class, 'destroy']);

//Compra
Route::post('compras', [CompraController::class, 'list']);
Route::get('compra/{id}', [CompraController::class, 'index']);
Route::post('compra/nuevo', [CompraController::class, 'store']);
Route::post('compra/eliminar', [CompraController::class, 'destroy']);

//Tamales
Route::post('tamales', [TamalController::class, 'list']);
Route::get('tamal/{id}', [TamalController::class, 'index']);
Route::post('tamal/nuevo', [TamalController::class, 'store']);
Route::post('tamal/eliminar', [TamalController::class, 'destroy']);

//Produccion

Route::get('producciones', [ProduccionController::class, 'index']); // con nombre_tamal
Route::get('producciones/base', [ProduccionController::class, 'list']); // sin relaciones (opcional)
Route::post('produccion/nuevo', [ProduccionController::class, 'store']);
Route::post('produccion/eliminar', [ProduccionController::class, 'destroy']);
