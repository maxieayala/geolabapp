<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Muestras\MuestrasController;
use App\Http\Controllers\Proyectos\ProyectosController;
use App\Http\Controllers\Proyectos\ClientesController;
use App\Http\Controllers\Opciones\CatalogosController;
use Illuminate\Support\Facades\Auth;
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
//catalalogo
Route::get('/catalogo', [CatalogosController::class, 'index'])->name('catalogo.index');
Route::post('/catalogoAdd', [CatalogosController::class, 'store'])->name('catalogo.store');
Route::put('/catalogoupdate', [CatalogosController::class, 'update'])->name('catalogo.update');

Route::delete('/catalogo/delete', [CatalogosController::class, 'destroy'])->name('catalogo.destroy');


//Muestras
Route::get('/muestras', [MuestrasController::class, 'index'])->name('muestras');
Route::get('/album', [MuestrasController::class, 'index'])->name('albumfotografico');

//Proyectos
Route::post('/proyectos/guardar', [ProyectosController::class, 'store'])->name('proyecto_guardar');
Route::get('/proyectos/{proyecto}', [ProyectosController::class, 'edit'])->name('proyecto_edit');
Route::put('/proyectos/{id}', [ProyectosController::class, 'update'])->name('proyectos.update');
Route::get('/proyectos/{proyecto}', [ProyectosController::class, 'show'])->name('proyectos.show');
Route::get('/proyecto', [ProyectosController::class, 'index'])->name('proyectos');
Route::get('/proyectoAdd', [ProyectosController::class, 'create'])->name('proyectosAgregar');
Route::get('/proyecto/exportar', [ProyectosController::class, 'export'])->name('proyectosExportar');

//Clientes
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes');
Route::get('/clientes/add', [ClientesController::class, 'create'])->name('clientes_Add');
Route::post('/clientes/guardar', [ClientesController::class, 'store'])->name('cliente_guardar');
Route::get('/clientes/{cliente}', [ClientesController::class, 'edit'])->name('cliente_edit');
Route::post('/clientes/{cliente}', [ClientesController::class, 'update'])->name('Cliente-update');


Route::get('/clientes/exportar', [ClientesController::class, 'export'])->name('clientes_Exportar');



Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');


    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
});
