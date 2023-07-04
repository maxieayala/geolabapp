<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $permissions = Permission::paginate(10);

        return view('permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('permissions.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'guard_name' => 'required',
            ]);

            Permission::create($request->all());

            DB::commit();

            return redirect()->route('permissions.index')->with('success', 'Permisos creado con exito.');
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('permissions.add')->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id): View
    {
        $permission = Permission::whereId($id)->first();

        return view('permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  request  $request, int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'guard_name' => 'required',
            ]);

            $permission = Permission::whereId($id)->first();

            $permission->name = $request->name;
            $permission->guard_name = $request->guard_name;
            $permission->save();

            DB::commit();

            return redirect()->route('permissions.index')->with('success', 'Se  actualizo de manera exitosa.');
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('permissions.edit', ['permission' => $permission])->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Permission::whereId($id)->delete();

            DB::commit();

            return redirect()->route('permissions.index')->with('success', 'El registro fué borrado');
        } catch (\Throwable $th) {
            DB::rollback();

            return redirect()->route('permissions.index')->with('error', $th->getMessage());
        }
    }
}
