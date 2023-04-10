<?php

namespace App\Http\Controllers\Opciones;

use App\Http\Controllers\Controller;
use App\Models\opciones\Catalogo;
use Illuminate\Http\Request;

class CatalogosController extends Controller
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
        $Catalogos = Catalogo::where('id_padre', '=', 0)->get();

        $allCatalogos = Catalogo::pluck('nombre', 'id')->all();

        return view('Opciones.catalogo.index', compact('Catalogos', 'allCatalogos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'nombre' => 'required',

        ]);

        $input = $request->all();

        $input['id_padre'] = empty($input['id_padre']) ? 0 : $input['id_padre'];



        Catalogo::create($input);

        return back()->with('success', 'New Catalogo added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function show(Catalogo $catalogo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalogo $catalogo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalogo $catalogo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalogo $catalogo)
    {
        //
    }
}
