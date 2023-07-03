<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage system setting')) {
            return view('admin.system-settings.index');
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

        if (Auth::user()->can('create system setting')) {
            return view('admin.system-settings.create');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemSetting $systemSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemSetting  $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSetting $systemSetting)
    {
        //
    }
    
}
