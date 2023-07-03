<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        // Check if the user is authenticated
        if (Auth::check()) {

            // Get the authenticated user
            $user = Auth::user();
            $permissions = Permission::pluck('name')->all();

            if ($user->hasAnyPermission($permissions)) {
                return redirect()->route('admin.home');
            }

            // if ($user->hasRole('super-admin')) {
            //     return redirect()->route('admin.home');
            // } elseif ($user->hasRole('Staff')) {
            //     return redirect()->route('staff.home');
            // }
        }
        // Fallback if the user doesn't have any of the specified roles or permissions
        return redirect()->route('default.applicant.dashboard');
    }
}
