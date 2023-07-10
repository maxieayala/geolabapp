<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use App\Models\Proyecto;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $total_proyectos = Proyecto::count();
        $total_muestras = Muestra::count();
        $sondeosPorMes = DB::table('sondeos')
            ->select(DB::raw('MONTHNAME(fecha) as mes, COUNT(*) as total'))
            ->groupBy('mes')
            ->get();

        return view('home', compact('total_proyectos', 'total_muestras', 'sondeosPorMes'));
    }

    /**
     * User Profile
     *
     *
     * @author
     */
    public function getProfile(): View
    {
        return view('profile');
    }

    /**
     * Update Profile
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        //Validations
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        try {
            DB::beginTransaction();

            //Update Profile Data
            User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
            ]);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('success', 'Se  actualizo de manera exitosa');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Hubo un error al actualizar el perfil');
        }
    }

    /**
     * Change Password
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();

            //Update Password
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

            //Commit Transaction
            DB::commit();

            //Return To Profile page with success

            return redirect()->back()->with('success', 'Se realizo el cambio de Contraseña');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Hubo un error al actualizar la contraseña');
        }
    }
}
