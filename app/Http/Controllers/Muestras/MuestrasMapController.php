<?php

namespace App\Http\Controllers\Muestras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MuestrasMapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the outlet listing in LeafletJS map.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('muestras.map');
    }
}
