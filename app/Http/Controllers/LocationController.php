<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage location')) {

            $locations = Location::latest()->paginate('20');

            if ($request->has('location_search')) {

                session()->put('location_search', $request->location_search);

                $locations = Location::query()->where('name', 'like', "%{$request->location_search}%")->latest()->paginate('20');

                $userSearch = session('location_search');

                $locations->appends(['location_search' => $userSearch]);
            }
            return view('admin.locations.index',compact('locations'));
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

            $wards = Ward::all();

            return view('admin.locations.create', compact('wards'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function createMultiple()
    {        
        if (Auth::user()->can('create location')) {
            $wards = Ward::all();
            return view('admin.locations.create-multiple',compact('wards'));
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

            $this->validate($request, [
                'name' => 'required|max:120',
                'ward_name' => 'required'
            ]);
    
            $names = is_array($request->name) ? $request->name : [$request->name];
    
            $existingNames = Location::whereIn('name', $names)->pluck('name')->toArray();
            $nonUniqueNames = array_intersect($names, $existingNames);
    
            if (!empty($nonUniqueNames)) {
                return redirect()->back()->withErrors(['name' => 'The following name(s) are already taken: ' . implode(', ', $nonUniqueNames)])->withInput();
            }
    
            foreach ($names as $name) {
                $location = new Location();
                $location->name = $name;
                $location->ward_name = $request->ward_name;
                $location->save();
            }
    
            return redirect()->route('location.index')->with('success', 'Location(s) created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update location')) {
            $id = decrypt($encryptedID);

            $location = Location::findOrFail($id);

            $ward_name = $location->ward_name;


            $wards = Ward::all(); // Example: Retrieve all wards for the dropdown menu

            // dd($roles);
            return view('admin.locations.edit', compact('location','ward_name','wards'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Auth::user()->can('update location')) {

            $this->validate($request, [
                'name' => 'required|unique:locations,name,' . $id,
                'ward_name' => 'required'
            ]);

            $location = Location::findOrFail($id);

            $location->name      = $request->name;
            $location->ward_name      = $request->ward_name;

            $location->touch();

            $location->save();

            return redirect()->route('location.index')->with('success', 'Location updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete location')) {

            $location = Location::findOrFail($id);

            $location->delete();

            return redirect()->route('location.index')->with('success', 'Location deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
