<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage location')) {

            $wards = Ward::latest()->paginate('20');

            if ($request->has('ward_search')) {

                session()->put('ward_search', $request->ward_search);

                $wards = Ward::query()->where('name', 'like', "%{$request->ward_search}%")->latest()->paginate('20');

                $userSearch = session('ward_search');

                $wards->appends(['ward_search' => $userSearch]);
            }

            return view('admin.wards.index', compact('wards'));
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
            $constituencies = Constituency::all();
            return view('admin.wards.create',compact('constituencies'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function createMultiple()
    {
        if (Auth::user()->can('create location')) {

            $constituencies = Constituency::all();
            return view('admin.wards.create-multiple',compact('constituencies'));
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

        // dd($request->all());

        if (Auth::user()->can('create location')) {

            $this->validate($request, [
                'name' => 'required|max:120',
                'constituency_id' => 'required'
            ]);
    
            $names = is_array($request->name) ? $request->name : [$request->name];
    
            $existingNames = Ward::whereIn('name', $names)->pluck('name')->toArray();
            $nonUniqueNames = array_intersect($names, $existingNames);
    
            if (!empty($nonUniqueNames)) {
                return redirect()->back()->withErrors(['name' => 'The following name(s) are already taken: ' . implode(', ', $nonUniqueNames)])->withInput();
            }
    
            foreach ($names as $name) {
                $ward = new Ward();
                $ward->name = $name;
                $ward->constituency_id = $request->constituency_id;
                $ward->save();
            }
    
            return redirect()->route('ward.index')->with('success', 'Ward(s) created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show(Ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update location')) {
            $id = decrypt($encryptedID);

            $ward = Ward::findOrFail($id);

            $constituencies = Constituency::all(); 

            // dd($roles);
            return view('admin.wards.edit', compact('ward','constituencies'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update location')) {

            $this->validate($request, [
                'name' => 'required|unique:wards,name,' . $id,
                'constituency_id' => 'required'

            ]);

            $ward = Ward::findOrFail($id);

            $ward->name      = $request->name;
            $ward->constituency_id      = $request->constituency_id;

            $ward->touch();

            $ward->save();

            return redirect()->route('ward.index')->with('success', 'County ward updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete location')) {

            // Step 1: Find the user
            $ward = Ward::findOrFail($id);

            $ward->delete();

            return redirect()->route('ward.index')->with('success', 'County ward deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
