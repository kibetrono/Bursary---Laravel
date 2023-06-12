<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StaffController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('staff.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }



    public function staffUsersList(Request $request)
    {   
        $role_name= "Staff";
        $staffUsers = User::whereHas('roles', function ($query) use ($role_name) {
            $query->where('name', $role_name);
        })->latest()->get();

        if($request->has('staff_user_search')){
            $role_name= "Staff";
            $staffUsers = User::where('name','like',"%{$request->staff_user_search}%")->orWhere('email','like',"%$request->staff_user_search%")->whereHas('roles', function ($query) use ($role_name) {
                $query->where('name', $role_name);
            })->latest()->get();
        }

        $searchTerm = $request->staff_user_search;

        return view('staff.staff_users.index',compact('staffUsers','searchTerm'));
    }

    public function staffUsersCreate()
    {   
        $role_name= "Staff";
        // $rolesss = Role::all();
        // dd($ro);
        $role = Role::where('name',$role_name)->get();
        return view('staff.staff_users.create',compact('role'));
    }

    public function staffUsersStore(Request $request)
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

        return redirect()->route('staff_users.list')->with('success','Staff created successfully');
    }

    public function showStaffUser($id)
    {   
      
        $user = User::find($id);
        return view('staff.staff_users.show',compact('user'));
    }

    public function editStaffUser($id)
    {
        // dd($id);
        $roles = Role::all();
        $user = User::findorFail($id);
        return view('staff.staff_users.edit',compact('user','roles'));
    }

    public function updateStaffUser(Request $request, $id)
    {
        // dd($request->all());

        $this->validate($request,[
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required'
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

        return redirect()->route('staff_users.list')->with('success','Staff updated successfully');
    }

    public function deleteStaffUser($id)
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

     return redirect()->route('staff_users.list')->with('success','Staff deleted successfully');
        

    }
}
