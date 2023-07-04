<?php

namespace App\Http\Controllers\Muestras;

use App\Http\Controllers\Controller;
use App\Models\Muestra;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MuestrasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $muestraQuery = Muestra::query();
        $muestraQuery->where('name', 'like', '%'.request('q').'%');
        $muestras = $muestraQuery->paginate(25);

        return view('muestras.index', compact('muestras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('muestras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', new muestra);

        $newmuestra = $request->validate([
            'name' => 'required|max:60',
            'address' => 'nullable|max:255',
            'latitude' => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $newmuestra['creator_id'] = auth()->id();

        $muestra = muestra::create($newmuestra);

        return redirect()->route('muestras.show', $muestra);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(Muestra $muestra)
    {
        return view('muestras.show', compact('muestra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Muestra $muestra)
    {
        $this->authorize('update', $muestra);

        return view('muestras.edit', compact('muestra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Muestra $muestra)
    {
        $this->authorize('update', $muestra);

        $muestraData = $request->validate([
            'name' => 'required|max:60',
            'address' => 'nullable|max:255',
            'latitude' => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $muestra->update($muestraData);

        return redirect()->route('muestras.show', $muestra);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Muestra $muestra, Request $request)
    {
        $this->authorize('delete', $muestra);

        $request->validate(['muestra_id' => 'required']);

        if ($request->get('muestra_id') == $muestra->id && $muestra->delete()) {
            return redirect()->route('muestras.index');
        }

        return redirect()->back()->with('success', 'Se  actualizo de manera exitosa');
    }
}
