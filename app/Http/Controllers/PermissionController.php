<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionController extends Controller
{
    // constructor(This ensures that only authenticated users shall be able to use this controller)

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $permissions = $this->permission::latest()->get();
        
        return view('admin.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.permissions.create');
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
    
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);
        // create the permission
        $this->permission->create([

            'name' => $request->name
        ]);

        return redirect()->route('permission.index')->with('success','Permission Created Successfully'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view("admin.permissions.show",compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         // Step 1: Find the permission
        $permission = Permission::findOrFail($id);

        // Step 2: Revoke the permission from all roles
        $roles = Role::all();
        foreach ($roles as $role) {
            $role->revokePermissionTo($permission);
        }

        // Step 3: Delete the permission
        $permission->delete();

        return redirect()->back()->with('success','Permission deleted successfully');
       
    }
}
