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

  public function show(Proyecto $proyecto)
  {
  }

  public function edit(Proyecto $proyecto)
  {
  }

  public function update(Request $request, Proyecto $proyecto)
  {
  }

  public function destroy(Proyecto $proyecto)
  {
  }

  public function export()
  {
    // return Excel::download(new UsersExport, 'users.xlsx');
  }
}
