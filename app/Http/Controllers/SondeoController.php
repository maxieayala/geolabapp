<?php

namespace App\Http\Controllers;

use App\Models\Sondeo;
use App\Models\Opciones\Catalogo;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Cliente;

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
        $clientes = Cliente::all();

        return view('sondeos.add', compact('tiposSondeo', 'clientes'));
    }

    /**
     * Esta función recupera todos los proyectos asociados con un ID de cliente determinado y los devuelve
     * como una respuesta JSON.
     *
     * @param clienteId El parámetro "clienteId" es una variable que representa el ID de un cliente. Se
     * utiliza en la función para recuperar todos los proyectos asociados con ese ID de cliente.
     *
     * @return Una respuesta JSON que contiene todos los proyectos asociados con el ID de cliente dado.
     */
    public function obtenerProyectos($clienteId)
    {
        $proyectos = Proyecto::where('cliente_id', $clienteId)->get();
        
        return response()->json($proyectos);
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


        return   $chart;
    }
}
