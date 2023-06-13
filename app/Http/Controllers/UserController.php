<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store', 'updateStatus']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }

    /**
     * List User
     *
     * @param Nill
     * @return array $user
     *
     * @author Shani Singh
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Create User
     *
     * @param Nill
     * @return array $user
     *
     * @author Shani Singh
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.add', ['roles' => $roles]);
    }

    /**
     * Store User
     *
     * @return View Users
     *
     * @author Shani Singh
     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id' => $request->role_id,
                'status' => $request->status,
                'password' => Hash::make($request->first_name.'@'.$request->mobile_number),
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();

            return redirect()->route('users.index')->with('success', 'Se creo de manera exitosa');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Update Status Of User
     *
     * @param  int  $status
     * @return List Page With Success
     *
     * @author Shani Singh
     */
    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'user_id' => $user_id,
            'status' => $status,
        ], [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:0,1',
        ]);

        // If Validations Fails
        if ($validate->fails()) {
            return redirect()->route('users.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            User::whereId($user_id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();

            return redirect()->route('users.index')->with('success', 'Se  actualizo de manera exitosa');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Edit User
     *
     * @param  int  $user
     * @return Collection $user
     *
     * @author Shani Singh
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit')->with([
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    /**
     * Update User
     *
     * @param  Request  $request, User $user
     * @return View Users
     *
     * @author Shani Singh
     */
    public function update(Request $request, User $user)
    {
        // Validations
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id.',id',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user_updated = User::whereId($user->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id' => $request->role_id,
                'status' => $request->status,
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();

            return redirect()->route('users.index')->with('success', 'Se  actualizo de manera exitosa');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Delete User
     *
     * @return Index Users
     *
     * @author Shani Singh
     */
    public function delete(User $user)
    {
        DB::beginTransaction();
        try {
            // Delete User
            User::whereId($user->id)->delete();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Usuario Eliminado!.');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Import Users
     *
     * @param null
     * @return View File
     */
    public function importUsers()
    {
        return view('users.import');
    }

    public function uploadUsers(Request $request)
    {
        Excel::import(new UsersImport, $request->file);

        return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
