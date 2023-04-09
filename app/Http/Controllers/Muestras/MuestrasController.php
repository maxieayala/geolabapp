<?php

namespace App\Http\Controllers\Muestras;

use App\Http\Controllers\Controller;
use App\Models\Muestra;
use Illuminate\Http\Request;

class MuestrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $muestraQuery = Muestra::query();
        $muestraQuery->where('name', 'like', '%'.request('q').'%');
        $muestras = $muestraQuery->paginate(25);

        return view('muestras.index', compact('muestras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('muestras.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new muestra);

        $newmuestra = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $newmuestra['creator_id'] = auth()->id();

        $muestra = muestra::create($newmuestra);

        return redirect()->route('muestras.show', $muestra);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Muestra  $muestra
     * @return \Illuminate\Http\Response
     */
    public function show(Muestra $muestra)
    {
        return view('muestras.show', compact('muestra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Muestra  $muestra
     * @return \Illuminate\Http\Response
     */
    public function edit(Muestra $muestra)
    {
        $this->authorize('update', $muestra);

        return view('muestras.edit', compact('muestra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Muestra  $muestra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Muestra $muestra)
    {
        $this->authorize('update', $muestra);

        $muestraData = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $muestra->update($muestraData);

        return redirect()->route('muestras.show', $muestra);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Muestra  $muestra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Muestra $muestra, Request $request )
    {
        $this->authorize('delete', $muestra);

        $request->validate(['muestra_id' => 'required']);

        if ($request->get('muestra_id') == $muestra->id && $muestra->delete()) {
            return redirect()->route('muestras.index');
        }

        return back();
    }
}
