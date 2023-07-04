<?php

namespace App\Http\Controllers\Opciones;

use App\Http\Controllers\Controller;
use App\Models\opciones\Catalogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CatalogosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $Catalogos = Catalogo::whereNull('id_padre')->get();

        return view('Opciones.catalogos.index', compact('Catalogos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function store(): View
    {
        $catalogos = Catalogo::all();

        return view('Opciones.catalogos.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'nombre' => 'required',
                'id_padre' => 'sometimes|nullable|numeric',
                'descripcion' => 'required|min:5|max:255|string',
            ]);

            Catalogo::create($request->all());

            DB::commit();

            return redirect()->route('catalogos.index')->with('success', 'Catalogo creado con exito');
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('catalogos.index')->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\View\View
     */
    public function show($id)   //muestra los catalogos en la tabla
    {
        $catalogo = Catalogo::findOrFail($id);

        return view('Opciones.catalogos.show', compact('catalogo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id) //llamo vista para editar catalogo
    {
        $catalogos = Catalogo::whereId($id)->first();

        return view('Opciones.catalogos.edit', ['catalogo' => $catalogos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //aca hago actualizacion full
    {
        $catalogo = Catalogo::findOrFail($id);

        $catalogo->nombre = $request->input('nombre');
        $catalogo->descripcion = $request->input('descripcion');

        $catalogo->save();

        return redirect()->route('catalogos.index', $catalogo->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        $catalogo = Catalogo::whereId($id)->first();
        $catalogo->delete();

        return redirect()->route('catalogos.index')->with('success', 'Catalogo eliminado exitosamente');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'catalogos.xlsx');
    }
}
