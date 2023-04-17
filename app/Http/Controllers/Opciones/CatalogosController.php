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
        $Catalogos = Catalogo::whereNull('id_padre')->get();
        return view('Opciones.catalogo.index', compact('Catalogos'));
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
        $validatedData = $this->validate($request, [
            'nombre'      => 'required|min:3|max:255|string',
            'id_padre' => 'sometimes|nullable|numeric'
      ]);

      Catalogo::create($validatedData);

      return redirect()->route('catalogo.index')->withSuccess('El catalogo se creo exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function show(Catalogo $catalogo)   //muestra los catalogos en la tabla
    {
        
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
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
  
        ]);

        $item = Catalogo::findOrFail($id); // Buscar el elemento por ID
        $item->nombre = $validatedData['nombre'];
  
        $item->save(); // Guardar los cambios en la base de datos

        // Redirigir al usuario a la misma vista
        return redirect()->route('catalogo.index', $item->id_padre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\opciones\Catalogo  $catalogo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalogo $catalogo)
    {
        if ($catalogo->children) {
            foreach ($catalogo->children()->with('posts')->get() as $child) {
                foreach ($child->posts as $post) {
                    $post->update(['catalogo_id' => NULL]);
                }
            }
            
            $catalogo->children()->delete();
        }

        foreach ($catalogo->posts as $post) {
            $post->update(['catalogo_id' => NULL]);
        }

        $catalogo->delete();

        return redirect()->route('catalogo.index')->withSuccess('You have successfully deleted a catalogo!');
    }
}
