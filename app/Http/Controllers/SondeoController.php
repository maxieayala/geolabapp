<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Muestra;
use App\Models\Opciones\Catalogo;
use App\Models\Proyecto;
use App\Models\Sondeo;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $search_query = request('search');
        try {

            $sondeos = Sondeo::getPaginatedData($search_query);
        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error');
        }

        $grafico = $this->stackedColumnChart();

        return view('sondeos.index', compact('sondeos'));
    }

    public function create()
    {
        $tiposSondeo = catalogo::where('id_padre', '=', '1')->get();
        //Mostame los clientes que tengan proyectos activos

        $clientes = Cliente::whereHas('Proyecto', function ($query) {
            $query->where('status', '=', 'Activo');
        })->pluck('Nombre', 'id');

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
        // Validate that $clienteId is not null
        if ($clienteId === null) {
            throw new \Exception('El cliente ID no puede ser nulo');
        }

        // Mostrame solo los proyectos que esten activos
        $proyectos = Proyecto::where('cliente_id', $clienteId)
            ->where('status', 'Activo')
            ->get()
            ->pluck('nombre', 'id');

        return response()->json($proyectos);
    }

    public function obtenerSondeos($proyectoId)
    {

        // Validate that $proyectoId is not null
        if ($proyectoId === null) {
            throw new \Exception('El proyecto ID no puede ser nulo');
        }

        $data = Sondeo::query()
            ->where('proyecto_id', $proyectoId)
            ->orderBy('id', 'DESC')
            ->get();

        return $data;
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'coordenada_x' => 'required',
            'coordenada_y' => 'required',
            'proyecto_id' => 'required',
            'fecha' => 'required',
        ]);

        // Iniciar la transacción en la base de datos
        DB::beginTransaction();

        try {
            // Crear el registro de sondeo
            $sondeo = Sondeo::create([
                'nombre' => $request->nombre,
                'coordenada_x' => $request->coordenada_x,
                'coordenada_y' => $request->coordenada_y,
                'proyecto_id' => $request->proyecto_id,
                'fecha' => $request->fecha,
                'tipo_sondeo_id' => 1,
                'banda' => $request->banda,
            ]);

            // Insertar las muestras en la tabla de muestras
            for ($i = 0; $i < count($request->muestras); $i++) {
                Muestra::create([
                    'sondeo_id' => $sondeo->id,
                    'profundidad_inicio' => $request->profundidad_inicio[$i],
                    'profundidad_fin' => $request->profundidad_fin[$i],
                    'descripcion' => $request->descripcion[$i],
                    // Otros campos necesarios para la tabla de muestras
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            // Redireccionar o mostrar un mensaje de éxito
            return redirect()->back()->with('success', 'Sondeo creado correctamente');
        } catch (\Exception $e) {
            // Revertir la transacción
            DB::rollBack();

            // Redireccionar o mostrar un mensaje de error
            return redirect()->back()->with('error', 'Hubo un error al crear el sondeo');
        }
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
