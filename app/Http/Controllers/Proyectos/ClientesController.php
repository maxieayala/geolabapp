<?php

namespace App\Http\Controllers\Proyectos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

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
        $tipo_clientes = catalogo::all();
       
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
        'last_name'     => 'required',
        'email'         => 'required|unique:users,email',
        'mobile_number' => 'required|numeric|digits:10',
        'tipo_cliente_id'       =>  'required|exists:tipo_clientes,id',
        'status'       =>  'required|numeric|in:0,1',
    ]);

    DB::beginTransaction();
    try {

        // Store Data
        $user = Cliente::create([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'mobile_number' => $request->mobile_number,
            'tipo_cliente_id'       => $request->tipo_cliente_id,
            'status'        => $request->status,
        ]);
        DB::commit();
        return redirect()->route('cliente.index')->with('success','Se creo de manera exitosa');

    } catch (\Throwable $th) {
        // Rollback and return with Error
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', $th->getMessage());
    }
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
    public function edit(Cliente $cliente)
    {
        //
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
