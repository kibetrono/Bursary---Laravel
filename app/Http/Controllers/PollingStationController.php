<?php

namespace App\Http\Controllers;

use App\Models\PollingStation;
use App\Models\SubLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PollingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage location')) {

            $pollingStations= PollingStation::latest()->paginate('20');

            if ($request->has('pollingstation_search')) {

                session()->put('pollingstation_search', $request->pollingstation_search);

                $pollingStations = PollingStation::query()->where('name', 'like', "%{$request->pollingstation_search}%")->latest()->paginate('20');

                $userSearch = session('pollingstation_search');

                $pollingStations->appends(['pollingstation_search' => $userSearch]);
            }
            
            return view('admin.polling-stations.index',compact('pollingStations'));
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

            $sub_locations = SubLocation::all();

            return view('admin.polling-stations.create', compact('sub_locations'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function createMultiple()
    {
        if (Auth::user()->can('create location')) {
            $sub_locations = SubLocation::all();
            return view('admin.polling-stations.create-multiple',compact('sub_locations'));
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
                'sublocation_id' => 'required'
            ]);
    
            $names = is_array($request->name) ? $request->name : [$request->name];
    
            $existingNames = PollingStation::whereIn('name', $names)->pluck('name')->toArray();
            $nonUniqueNames = array_intersect($names, $existingNames);
    
            if (!empty($nonUniqueNames)) {
                return redirect()->back()->withErrors(['name' => 'The following name(s) are already taken: ' . implode(', ', $nonUniqueNames)])->withInput();
            }
    
            foreach ($names as $name) {
                $polling_station = new PollingStation();
                $polling_station->name = $name;
                $polling_station->sublocation_id = $request->sublocation_id;
                $polling_station->save();
            }
    
            return redirect()->route('polling-station.index')->with('success', 'Polling Station(s) created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollingStation  $pollingStation
     * @return \Illuminate\Http\Response
     */
    public function show(PollingStation $pollingStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PollingStation  $pollingStation
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update location')) {
            $id = decrypt($encryptedID);

            $pollingStation = PollingStation::findOrFail($id);

            $subLocations = SubLocation::all(); // Example: Retrieve all wards for the dropdown menu

            // dd($roles);
            return view('admin.polling-stations.edit', compact('pollingStation','subLocations'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollingStation  $pollingStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Auth::user()->can('update location')) {

            $this->validate($request, [
                'name' => 'required|unique:polling_stations,name,' . $id,
                'sublocation_id' => 'required'
            ]);

            $polling_station = PollingStation::findOrFail($id);

            $polling_station->name      = $request->name;
            $polling_station->sublocation_id      = $request->sublocation_id;

            $polling_station->touch();

            $polling_station->save();

            return redirect()->route('polling-station.index')->with('success', 'Polling Station updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollingStation  $pollingStation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete location')) {

            $polling_station = PollingStation::findOrFail($id);

            $polling_station->delete();

            return redirect()->route('polling-station.index')->with('success', 'Polling Station deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
