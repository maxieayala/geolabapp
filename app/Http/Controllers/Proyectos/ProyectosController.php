<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $proyectos = Proyecto::with(['clientes' => function ($query) {
      $query->orderBy('created_at', 'desc');
    }])
      ->orderBy('proyectos.id', 'desc')
      ->paginate(5);

    return view('proyectos.index', compact('proyectos'));
  }

  public function create()
  {
    $todos_los_clientes = Cliente::all();
    return view('proyectos.add', compact('todos_los_clientes'));
  }

  public function store(Request $request)
  {
    $proyecto = Proyecto::create([
      'nombre' => $request->input('nombre'),
      'direccion' => $request->input('direccion'),
      'ubicacion' => $request->input('ubicacion'),
      'fecha_inicio' => $request->input('fecha_inicio'),
      'fecha_fin' => $request->input('fecha_fin'),
      'nombre_contacto' => $request->input('nombre_contacto'),
      'telefono_contacto' => $request->input('telefono_contacto'),
      'status' => $request->input('status'),
      'cliente_id' => $request->input('cliente_id'),
    ]);

    return redirect()->route('proyectos');
  }

  public function add()
  {
    $clientes = Cliente::all();
    return view('proyectos.add', compact('clientes'));
  }

  public function show($id)
  {
    $proyecto = Proyecto::findOrFail($id);

    return view('proyectos.show', compact('proyecto'));
  }

  public function edit($id)
  {        
    $proyecto = Proyecto::whereId($id)->first();
    $todos_los_clientes = Cliente::all();

    return view('proyectos.edit', ['proyecto' => $proyecto, 'todos_los_clientes' => $todos_los_clientes]);
  }

  public function update(Request $request, $id)
  {
    // Buscar el registro a actualizar en la base de datos
    $proyecto = Proyecto::findOrFail($id);

    // Actualizar los campos del registro con los nuevos valores

    $proyecto->nombre = $request->input('nombre');
    $proyecto->direccion = $request->input('direccion');
    $proyecto->ubicacion = $request->input('ubicacion');
    $proyecto->fecha_inicio = $request->input('fecha_inicio');
    $proyecto->fecha_fin = $request->input('fecha_fin');
    $proyecto->nombre_contacto = $request->input('nombre_contacto');
    $proyecto->telefono_contacto = $request->input('telefono_contacto');
    $proyecto->status = $request->input('status');
    $proyecto->cliente_id = $request->input('cliente_id');

    // Guardar los cambios en la base de datos
    $proyecto->save();

    // Redirigir al usuario a la página de detalles del recurso actualizado
    return redirect()->route('proyectos.show', $proyecto->id);
  }

  public function destroy(Proyecto $proyecto)
  {
  }

  public function export()
  {
    // return Excel::download(new UsersExport, 'users.xlsx');
  }
}
