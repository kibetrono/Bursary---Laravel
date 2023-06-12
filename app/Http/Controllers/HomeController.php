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

            // Check the user's roles and permissions
            if ($user->hasRole('super-admin')) {
                return redirect()->route('admin.home');
            } elseif ($user->hasRole('Staff')) {
                return redirect()->route('staff.home');
            }
            elseif ($user->hasRole('SchoolRole')) {
                return redirect()->route('school.home');
            }
           
        }

        // Fallback if the user doesn't have any of the specified roles or permissions
        return view('applicant.dashboard');
    }
}
