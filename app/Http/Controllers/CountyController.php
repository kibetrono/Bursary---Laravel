<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage location')) {

            $counties = County::latest()->paginate('10');

            if ($request->has('county_search')) {

                session()->put('county_search', $request->county_search);
                $counties = County::query()->where('name', 'like', "%{$request->county_search}%")->latest()->paginate('10');
                $userSearch = session('county_search');
                $counties->appends(['county_search' => $userSearch]);
            }

            return view('admin.counties.index', compact('counties'));
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
        if (Auth::user()->can('create location')) {

            return view('admin.counties.create');
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
        if (Auth::user()->can('create location')) {

            // dd($request->all());
            $this->validate($request, [
                'name' => 'required|max:120|unique:counties',
                'county_number' => 'required'

            ]);

            $county               = new County();
            $county->name      = $request->name;
            $county->county_number      = $request->county_number;
            $county->save();

            return redirect()->route('county.index')->with('success', 'County created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function show(County $county)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update location')) {
            $id = decrypt($encryptedID);

            $county = County::findOrFail($id);

            // dd($roles);
            return view('admin.counties.edit', compact('county'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update location')) {

            $this->validate($request, [
                'name' => 'required|max:120|unique:counties,name,' . $id,
                'county_number' => 'required'
            ]);

            $county = County::findOrFail($id);
            $county->name               = $request->name;
            $county->county_number      = $request->county_number;

            $county->touch();
            $county->save();

            return redirect()->route('county.index')->with('success', 'County updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\County  $county
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete location')) {

            // Step 1: Find the user
            $county = County::findOrFail($id);
            $county->delete();

            return redirect()->route('county.index')->with('success', 'County deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

            
}
