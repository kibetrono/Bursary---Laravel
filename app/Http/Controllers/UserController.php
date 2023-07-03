<?php

namespace App\Http\Controllers;

use App\Models\Bursary;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage user')) {

            $roles = Role::latest()->get();
            // $users = User::latest()->get();

            $users = User::query()->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'super-admin');
            })->latest()->paginate('10');

            if ($request->has('user_search')) {
                session()->put('user_search', $request->user_search);

                $users = User::query()->where(function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->user_search}%")
                        ->orWhere('email', 'like', "%{$request->user_search}%");
                })
                    ->whereDoesntHave('roles', function ($query) {
                        $query->where('name', 'super-admin');
                    })
                    ->latest()->paginate('10');
                $userSearch = session('user_search');

                $users->appends(['user_search' => $userSearch]);
            }

            $searchTerm = $request->user_search;

            return view('admin.users.index', compact('users', 'roles', 'searchTerm'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    // public function index(Request $request)
    // {   
    //     $roles = Role::all();
    //     $users = User::latest()->get();

    //     $id = $request->input('id');
    //     $name = $request->input('name');
    //     $email = $request->input('email');
    //     $user_type = $request->input('user_type');

    //     $query = \App\Models\User::query();

    //     if (!empty($id) || $id == '0') {
    //         $query->where('id', $id );
    //     }

    //     if (!empty($name)) {
    //         $query->where('name', 'LIKE', '%' . $name . '%');
    //     }

    //     if (!empty($email)) {
    //         $query->where('email', 'LIKE', '%' . $email . '%');
    //     }

    //     if (!empty($user_type) || $user_type == '0') {
    //         $query->where('user_type', $user_type);
    //     }

    //     $users = $query->get();



    //     // if($request->has('user_search')){
    //     //     $roles = Role::all();
    //     //     $users = User::where('name','like',"%{$request->user_search}%")->orWhere('email','like',"%$request->user_search%")->get();
    //     // }

    //     $searchTerm = $request->user_search;

    //     return view('admin.users.index',compact('users','roles','searchTerm','id','name','email','user_type'));

    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create user')) {

            $roles = Role::all();

            return view('admin.users.create', compact('roles'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create user')) {

            // dd($request->all());
            $this->validate($request, [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                // 'phone' => 'required',
                'role' => 'required',

            ]);

            $user               = new User();

            $user->name      = $request->name;
            $user->email      = $request->email;
            $user->password   = Hash::make($request->password);
            // $user->phone      = $request->phone;

            // saving role
            $user->assignRole($request->role);

            // saving permission
            // if($request->has('permissions')){
            //     $user->givePermissionTo($request->permission);
            // }


            $user->save();

            return redirect()->route('user.index')->with('success', 'User created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($encryptedID)
    {
        if (Auth::user()->can('view user')) {
            $id= decrypt($encryptedID);
            $user = User::find($id);
            return view('admin.users.show', compact('user'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('edit user')) {
            $id= decrypt($encryptedID);
            
            $roles = Role::all();

            $user = User::findOrFail($id);

            // dd($roles);
            return view('admin.users.edit', compact('user', 'roles'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit user')) {

            // dd($request->all());

            $this->validate($request, [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6|confirmed',
                'role' => 'nullable'
            ]);

            $user = User::findOrFail($id);

            $user->name      = $request->name;
            $user->email      = $request->email;
            // $user->phone      = $request->phone;

            if ($request->has('password') && $request['password'] !== null) {
                $user->password   = Hash::make($request->password);
            }

            // working with roles
            if ($request->has('role')) {
                $userRole = $user->getRoleNames();
                foreach ($userRole as $role) {
                    $user->removeRole($role);
                }
                // saving new role
                $user->assignRole($request->role);
            }

            // working with permissions
            // if($request->has('permissions')){
            //     $userPermissions = $user->getPermissionNames();
            //     foreach ($userPermissions as $permission) {
            //         $user->revokePermissionTo($permission);
            //     }

            //     $user->givePermissionTo($request->permission);
            // }

            // Update the updated_at field manually
            $user->touch();

            $user->save();

            return redirect()->route('user.index')->with('success', 'User updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete user')) {

            // Step 1: Find the user
            $user = User::findOrFail($id);

            if ($user->hasRole('super-admin')) {
                return redirect()->back()->with('warning', 'User with "super-admin" role cannot be deleted!!!');
            }

            // Step 2: Revoke all permissions from the user
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                $user->revokePermissionTo($permission);
            }

            // Step 3: Remove all roles from the user
            $roles = Role::all();
            foreach ($roles as $role) {
                $user->removeRole($role);
            }

            // Step 4: Delete the user
            //  $user->delete();

            $deleted = $user->delete();

            if ($deleted) {

                Bursary::where('user_id', $id)->delete();
            }

            return redirect()->route('user.index')->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    
}
