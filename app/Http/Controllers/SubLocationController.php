<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\SubLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage location')) {
            $subLocations = SubLocation::latest()->paginate('20');

            if ($request->has('sublocation_search')) {

                session()->put('sublocation_search', $request->sublocation_search);

                $subLocations = SubLocation::query()->where('name', 'like', "%{$request->sublocation_search}%")->latest()->paginate('20');

                $userSearch = session('sublocation_search');

                $subLocations->appends(['sublocation_search' => $userSearch]);
            }

            return view('admin.sub-locations.index',compact('subLocations'));
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

            $locations = Location::all();

            return view('admin.sub-locations.create', compact('locations'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function createMultiple()
    {
        if (Auth::user()->can('create location')) {
            $locations = Location::all();
            return view('admin.sub-locations.create-multiple',compact('locations'));
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
                'location_id' => 'required'
            ]);
    
            $names = is_array($request->name) ? $request->name : [$request->name];
    
            $existingNames = SubLocation::whereIn('name', $names)->pluck('name')->toArray();
            $nonUniqueNames = array_intersect($names, $existingNames);
    
            if (!empty($nonUniqueNames)) {
                return redirect()->back()->withErrors(['name' => 'The following name(s) are already taken: ' . implode(', ', $nonUniqueNames)])->withInput();
            }
    
            foreach ($names as $name) {
                $sub_location = new SubLocation();
                $sub_location->name = $name;
                $sub_location->location_id = $request->location_id;
                $sub_location->save();
            }
    
            return redirect()->route('sub-location.index')->with('success', 'Sub-Location(s) created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function show(SubLocation $subLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update location')) {
            $id = decrypt($encryptedID);

            $sub_location = SubLocation::findOrFail($id);

            $locations = Location::all(); // Example: Retrieve all wards for the dropdown menu

            // dd($roles);
            return view('admin.sub-locations.edit', compact('sub_location','locations'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update location')) {

            $this->validate($request, [
                'name' => 'required|unique:sub_locations,name,' . $id,
                'location_id' => 'required'
            ]);

            $sub_location = SubLocation::findOrFail($id);

            $sub_location->name      = $request->name;
            $sub_location->location_id      = $request->location_id;

            $sub_location->touch();

            $sub_location->save();

            return redirect()->route('sub-location.index')->with('success', 'Sub-Location updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubLocation  $subLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete location')) {

            $sub_location = SubLocation::findOrFail($id);

            $sub_location->delete();

            return redirect()->route('sub-location.index')->with('success', 'Sub-Location deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
