<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\proyecto\ProyectosFotos;
use Illuminate\Http\Request;

class ProyectoFotosController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\proyecto\ProyectosFotos  $proyectosFotos
     * @return \Illuminate\Http\Response
     */
    public function show(ProyectosFotos $proyectosFotos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\proyecto\ProyectosFotos  $proyectosFotos
     * @return \Illuminate\Http\Response
     */
    public function edit(ProyectosFotos $proyectosFotos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\proyecto\ProyectosFotos  $proyectosFotos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProyectosFotos $proyectosFotos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\proyecto\ProyectosFotos  $proyectosFotos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProyectosFotos $proyectosFotos)
    {
        //
    }
}
