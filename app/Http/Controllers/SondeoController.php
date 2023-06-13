<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Opciones\Catalogo;
use App\Models\Proyecto;
use App\Models\Sondeo;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SondeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sondeos = Sondeo::all();
        $grafico = $this->stackedColumnChart();

        return view('sondeos.index', compact('sondeos'));
    }

    public function create()
    {
        $tiposSondeo = catalogo::where('id_padre', '=', '1')->get();
        $clientes = Cliente::pluck('Nombre', 'id');

        return view('sondeos.add', compact('tiposSondeo', 'clientes'));
    }

    /**
     * Esta función recupera todos los proyectos asociados con un ID de cliente determinado y los devuelve
     * como una respuesta JSON.
     *
     * @param clienteId El parámetro "clienteId" es una variable que representa el ID de un cliente. Se
     * utiliza en la función para recuperar todos los proyectos asociados con ese ID de cliente.
     * @return Una respuesta JSON que contiene todos los proyectos asociados con el ID de cliente dado.
     */
    public function obtenerProyectos($clienteId)
    {

        $proyectos = Proyecto::where('cliente_id', $clienteId)->get()->pluck('nombre', 'id');

        return response()->json($proyectos);
    }

    public function getSondeos($proyectoId)
    {
        $sondeo = Sondeo::where('proyecto_id', $proyectoId)->get();

        return DataTables::of($sondeo)->make(true)
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0);" class="btn btn-warning btn-sm editbtn" data-id="'.$row->id.'"><i class="fas fa-edit"></i></a>';
                $btn = $btn.'&nbsp&nbsp<a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-danger btn-sm deletebtn"> <i class="fas fa-trash"></i> </a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'coordenada_x' => 'required',
            'coordenada_y' => 'required',
            'tipo_sondeo_id' => 'required',
            'proyecto_id' => 'required',
            'fecha' => 'required',
            'metodos_perforacion' => 'required',
            'instrumentacion' => 'required',
        ]);

        Sondeo::create($request->all());

        return redirect()->route('sondeos.index')->with('success', 'Sondeo created successfully.');
    }

    public function show(Sondeo $sondeo)
    {
        return view('sondeos.show', compact('sondeo'));
    }

    public function edit(Sondeo $sondeo)
    {
        $tiposSondeo = Catalogo::all();
        $proyectos = Proyecto::all();

        return view('sondeos.edit', compact('sondeo', 'tiposSondeo', 'proyectos'));
    }

    public function update(Request $request, Sondeo $sondeo)
    {
        $request->validate([
            'coordenada_x' => 'required',
            'coordenada_y' => 'required',
            'tipo_sondeo_id' => 'required',
            'proyecto_id' => 'required',
            'fecha' => 'required',
            'metodos_perforacion' => 'required',
            'instrumentacion' => 'required',
        ]);

        $sondeo->update($request->all());

        return redirect()->route('sondeo.index')->with('success', 'Sondeo updated successfully.');
    }

    public function destroy(Sondeo $sondeo)
    {
        $sondeo->delete();

        return redirect()->route('sondeo.index')->with('success', 'Sondeo deleted successfully.');
    }

    public function stackedColumnChart()
    {
        $chart = new LarapexChart();

        return $chart;
    }
}
