<?php

namespace App\Http\Controllers;


use App\Models\Proyecto;
use App\Models\Muestra;
use App\Models\Sondeo;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $usersCount = Muestra::where('status', 'active')->count();
        $total_proyectos = Proyecto::count();
        $total_muestras = Muestra::count();

        //    $sondeosPorMes = Sondeo::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
        //         ->whereYear('created_at', date('Y'))
        //         ->groupBy(DB::raw("month_name"))
        //         ->orderBy('id', 'ASC')
        //         ->pluck('count', 'month_name');

        //     $labels = $sondeosPorMes->keys();
        //     $data = $sondeosPorMes->values();
        $sondeosPorMes = DB::table('sondeos')
            ->select(DB::raw('MONTHNAME(fecha) as mes, COUNT(*) as total'))
            ->groupBy('mes')
            ->get();

        return view('home', compact('total_proyectos', 'total_muestras', 'sondeosPorMes'));
    }

    /**
     * User Profile
     *
     * @param Nill
     * @return View Profile
     *
     * @author Shani Singh
     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Update Profile
     *
     * @param $profileData
     * @return bool With Success Message
     *
     * @author Shani Singh
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

            //Return To Profile page with success
            return back()->with('success', 'Se  actualizo de manera exitosa');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Change Password
     *
     * @param Old Password, New Password, Confirm New Password
     * @return bool With Success Message
     *
     * @author Shani Singh
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
            return back()->with('success', 'Se realizo el cambio de Contraseña');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', $th->getMessage());
        }
    }
}
