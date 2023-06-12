<?php

namespace App\Http\Controllers;

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
        $roles = Role::latest()->get();
        $users = User::latest()->get();

        if($request->has('user_search')){
            $roles = Role::latest()->get;
            $users = User::where('name','like',"%{$request->user_search}%")->orWhere('email','like',"%$request->user_search%")->get();
        }

        $searchTerm = $request->user_search;

        return view('admin.users.index',compact('users','roles','searchTerm'));

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
        $roles = Role::all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
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

        return redirect()->route('user.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }


 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $roles = Role::all();

        $user = User::findOrFail($id);
        
        // dd($roles);
        return view('admin.users.edit',compact('user','roles'));
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
        // dd($request->all());

        $this->validate($request,[
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'nullable'
        ]);

        $user = User::findOrFail($id);

        $user->name      = $request->name;
        $user->email      = $request->email;
        // $user->phone      = $request->phone;

        if($request->has('password') && $request['password'] !== null){
            $user->password   = Hash::make($request->password);
        }

        // working with roles
        if($request->has('role')){
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

        $user->save();

        return redirect()->route('user.index')->with('success','User updated successfully');
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        // dd($id);

     // Step 1: Find the user
     $user = User::findOrFail($id);

     if($user->hasRole('super-admin')){
        return redirect()->back()->with('warning','User with admin role cannot be deleted');
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
     $user->delete();

     return redirect()->route('user.index')->with('success','User deleted successfully');
        

    }
}
