<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{


    // constructor(This ensures that only authenticated users shall be able to use this controller)

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware("auth");
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role::latest()->get(); // all roles
        // $roles = $this->role::whereNotIn('name',['super-admin'])->get(); // all roles except for super-admin

        // dd($roles);
        
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        // dd($permissions);
        return view('admin.roles.create',compact('permissions'));
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
            'name'=>'required|string|unique:roles',
            'permissions'=>'nullable',
        ]);

        $role = $this->role->create([

            'name' => $request->name,
        ]);

        if($request->has('permissions')){
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('role.index')->with('success','Role Created Successfully'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view("admin.roles.show",compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $permissions = Permission::all();
        $role = Role::findById($id);
        return view('admin.roles.edit',compact('role','permissions'));
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
        $role = Role::findOrFail($id);


        $this->validate($request,[
            'name'=>'required|string|unique:roles,name,'.$role->id,
            'permissions'=>'nullable',
        ]);


        $role->name      = $request->input('name');
        // $user->phone      = $request->phone;
        $role->save();

        if($request->has('permissions')){
            $permissions = $request->input('permissions',[]);
            $role->syncPermissions($permissions);
        }


        return redirect()->route('role.index')->with('success','Role updated successfully');
        
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   

        // Step 1: Find the role
    $role = Role::findOrFail($id);

    if($role->name == 'super-admin'){

    return redirect()->back()->with('warning','Admin role cannot be deleted');

    }

    // Step 2: Revoke all permissions from the role
    $permissions = Permission::all();
    foreach ($permissions as $permission) {
        $role->revokePermissionTo($permission);
    }

    // Step 3: Delete the role
    $role->delete();

    return redirect()->back()->with('success','Role deleted successfully');

    }
}
