<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            ->orderBy('id', 'desc')
            ->paginate(5);

        $proyectos->getCollection()->transform(function ($proyecto) {
            $proyecto->nombre_cliente = Cliente::findOrFail($proyecto->cliente_id)->Nombre;

            return $proyecto;
        });

        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $todos_los_clientes = Cliente::all();

        return view('proyectos.add', compact('todos_los_clientes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cliente_id' => 'required',
            'telefono_contacto' => 'numeric',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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

    public function eliminar(Request $request, $id)
    {
        $proyecto = Proyecto::whereId($id)->first();
        $proyecto->delete();

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado exitosamente');
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        $proyecto->nombre = $request->input('nombre');
        $proyecto->direccion = $request->input('direccion');
        $proyecto->ubicacion = $request->input('ubicacion');
        $proyecto->fecha_inicio = $request->input('fecha_inicio');
        $proyecto->fecha_fin = $request->input('fecha_fin');
        $proyecto->nombre_contacto = $request->input('nombre_contacto');
        $proyecto->telefono_contacto = $request->input('telefono_contacto');
        $proyecto->status = $request->input('status');
        $proyecto->cliente_id = $request->input('cliente_id');

        $proyecto->save();

        return redirect()->route('proyectos.show', $proyecto->id);
    }

    public function export()
    {
        // return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function agregarAdjunto(Request $request, Proyecto $proyecto)
    {
        // Validar y procesar los datos del formulario

        $proyectoDetalleAdjunto = new ProyectoDetalleAdjunto();
        // Asignar los valores de los campos del formulario al modelo $proyectoDetalleAdjunto

        $proyecto->proyectoDetalleAdjuntos()->save($proyectoDetalleAdjunto);

        // Redireccionar a la vista de detalles del proyecto
        return redirect()->route('proyecto.detalles', $proyecto->id);
    }
}
