<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\proyecto\ProyectosFotos;
use Illuminate\View\View;

class ProyectoFotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $proyectos_fotos = ProyectosFotos::all();

        return view('proyectos.fotos.index', compact('proyectos_fotos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): view
    {
        return view('proyectos.fotos.add');
    }
}
