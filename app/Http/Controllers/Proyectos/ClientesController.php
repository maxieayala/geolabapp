<?php

namespace App\Http\Controllers\Proyectos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Opciones\Catalogo;

class ClientesController extends Controller
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
        $clientes = Cliente::paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aca hacer un select especifico

        $tipo_clientes = catalogo::where('id_padre', '=', '1')->get();

        return view('clientes.add', ['tipo_clientes' => $tipo_clientes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     // Validations
     $request->validate([
        'nombre'    => 'required',
        'email'         => 'required',
        'telefono' => 'required|digits:8',
        'cliente_id'       =>  'required',
        'status'       =>  'required|numeric|in:0,1',
    ]);
    // dd($request);
    DB::beginTransaction();
    // try {

        // Store Data
        $Cliente = Cliente::create([
            'nombre'    => $request->nombre,
            'email'         => $request->email,
            'telefono' => $request->telefono,
            'tipocliente_id'       => $request->cliente_id,
            'status'        => $request->status,
            'ruc'        => $request->ruc,
            'direccion' => $request->ruc,
        ]);

        DB::commit();
        return redirect()->route('clientes')->with('success','Se creo de manera exitosa');

    // } catch (\Throwable $th) {
    //     // Rollback and return with Error
    //     DB::rollBack();
    //     return redirect()->back()->withInput()->with('error', $th->getMessage());
    // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::whereId($id)->first();

        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
    public function export()
    {
        // return Excel::download(new UsersExport, 'users.xlsx');
    }
}
