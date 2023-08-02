<?php

namespace App\Http\Controllers;

use App\Mail\CreateStaff;
use App\Mail\RoleAssigned;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Bursary;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage staff')) {
            $role_name = "Staff";
            $staffUsers = User::query()->whereHas('roles', function ($query) use ($role_name) {
                $query->where('name', $role_name);
            })->latest()->paginate('10');

            if ($request->has('staff_user_search') && $request->staff_user_search != null) {
                session()->put('staff_user_search', $request->staff_user_search);

                $role_name = "Staff";
                $staffUsers = User::query()->where('name', 'like', "%{$request->staff_user_search}%")->orWhere('email', 'like', "%$request->staff_user_search%")->whereHas('roles', function ($query) use ($role_name) {
                    $query->where('name', $role_name);
                })->latest()->paginate('1');
                $userSearch = session('staff_user_search');

                $staffUsers->appends(['staff_user_search' => $userSearch]);
            }

            return view('staff.staff_users.index', compact('staffUsers'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create staff')) {

            $role_name = "Staff";
            // $rolesss = Role::all();
            // dd($ro);
            $role = Role::where('name', $role_name)->get();
            return view('staff.staff_users.create', compact('role'));
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
        if (Auth::user()->can('create staff')) {

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

            $user->save();

            if ($user->save()) {
                $createStaffValue = SystemSetting::where('name', 'create_staff')->value('value');
                if ($createStaffValue == 1) {
                    try {
                        $name = $request->name;
                        $role = Role::findorFail($request->role);

                        Mail::to($request->email)->send(new CreateStaff($name, $role));
                    } catch (\Exception $e) {
                        $smtp_error = __('E-Mail has not been sent due to SMTP configuration');
                    }
                }
            }
            return redirect()->route('staff.index')->with('success', __('Staff created successfully.'))->with('smtp_error', (isset($smtp_error)) ? $smtp_error  : '');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($encryptedID)
    {
        if (Auth::user()->can('view staff')) {

            $id = decrypt($encryptedID);
            $user = User::find($id);
            $attendedApprovedBursaries = Bursary::where('staff_id', $id)->where('status', '=', '1')->count();
            $attendedRejectedBursaries = Bursary::where('staff_id', $id)->where('status', '=', '2')->count();
            return view('staff.staff_users.show', compact('user', 'attendedApprovedBursaries', 'attendedRejectedBursaries'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('edit staff')) {

            // dd($id);
            $id = decrypt($encryptedID);
            $roles = Role::all();
            $user = User::findorFail($id);
            return view('staff.staff_users.edit', compact('user', 'roles'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit staff')) {

            // dd($request->all());

            $this->validate($request, [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6|confirmed',
                'role' => 'required'
            ]);

            $user = User::findOrFail($id);
            $myOriginalRoles = $user->getRoleNames(); // for using to send emails


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

            // Update the updated_at field manually
            $user->touch();

            $user->save();

            $updatedRoles = $user->getRoleNames(); // to allow me to send email

            if ($user->save()) {
                if ($request->has('role')) {
                    $staffAssignRoleValue = SystemSetting::where('name', 'role_assigned')->value('value');
                    if ($staffAssignRoleValue == 1) {
                        try {
                            // send email only if role changed
                            if ($myOriginalRoles != $updatedRoles) {
                                $name = $request->name;
                                $role = Role::findorFail($request->role);
                                $url = url('home');
                                Mail::to($request->email)->send(new RoleAssigned($name, $role, $url));
                            }
                        } catch (\Exception $e) {
                            $smtp_error = __('E-Mail has not been sent due to SMTP configuration');
                        }
                    }
                }
            }
            return redirect()->route('staff.index')->with('success', __('Staff updated successfully.'))->with('smtp_error', (isset($smtp_error)) ? $smtp_error  : '');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete staff')) {

            // Step 1: Find the user
            $user = User::findOrFail($id);

            if ($user->hasRole('super-admin')) {
                return redirect()->back()->with('warning', 'User with admin role cannot be deleted');
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

            return redirect()->route('staff.index')->with('success', 'Staff deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function viewUserApprovedTasks(Request $request, $encryptedID)
    {
        if (Auth::user()->can('manage bursary')) {

            $id = decrypt($encryptedID);
            $user = User::findorFail($id);

            $approvedBursaries = Bursary::where('staff_id', $id)->where('status', '=', '1')->paginate('10');

            if ($request->has('approved_search_by_staff')) {

                $user = User::findorFail($id);
                $approvedBursaries = Bursary::where('staff_id', $id)->where('adm_or_reg_no', 'like', "%{$request->approved_search_by_staff}%")->where('status', '=', '1')->paginate('10');
            }

            $searchTerm = $request->approved_search_by_staff;

            return view('staff.staff_users.show-approved-applications', compact('user', 'approvedBursaries', 'searchTerm'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function viewUserRejectedTasks(Request $request, $encryptedID)
    {
        if (Auth::user()->can('manage bursary')) {

            $id = decrypt($encryptedID);

            $user = User::findorFail($id);

            $rejectedBursaries = Bursary::where('staff_id', $id)->where('status', '=', '2')->paginate('10');

            if ($request->has('rejected_search_by_staff')) {

                $user = User::findorFail($id);
                $rejectedBursaries = Bursary::where('staff_id', $id)->where('adm_or_reg_no', 'like', "%{$request->rejected_search_by_staff}%")->where('status', '=', '2')->paginate('10');
            }

            $searchTerm = $request->rejected_search_by_staff;

            return view('staff.staff_users.show-rejected-applications', compact('user', 'rejectedBursaries', 'searchTerm'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
