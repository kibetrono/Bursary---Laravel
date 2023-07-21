<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\County;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ConstituencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->can('manage location')) {

            $constituencies = Constituency::latest()->paginate('20');

            if ($request->has('constituency_search')) {

                session()->put('constituency_search', $request->constituency_search);

                $constituencies = Constituency::query()->where('name', 'like', "%{$request->constituency_search}%")->latest()->paginate('20');

                $userSearch = session('constituency_search');

                $constituencies->appends(['constituency_search' => $userSearch]);
            }

            return view('admin.constituencies.index', compact('constituencies'));
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

            $counties = County::all();
            return view('admin.constituencies.create',compact('counties'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function createMultiple()
    {
        if (Auth::user()->can('create location')) {

            $counties = County::all();
            return view('admin.constituencies.create-multiple',compact('counties'));
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
                'county_id' => 'required'
            ]);
    
            $names = is_array($request->name) ? $request->name : [$request->name];
    
            $existingNames = Constituency::whereIn('name', $names)->pluck('name')->toArray();
            $nonUniqueNames = array_intersect($names, $existingNames);
    
            if (!empty($nonUniqueNames)) {
                return redirect()->back()->withErrors(['name' => 'The following name(s) are already taken: ' . implode(', ', $nonUniqueNames)])->withInput();
            }
    
            foreach ($names as $name) {
                $constituency = new Constituency();
                $constituency->name = $name;
                $constituency->county_id = $request->county_id;
                $constituency->save();
            }
    
            return redirect()->route('constituency.index')->with('success', 'Constituency(s) created successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Constituency  $constituency
     * @return \Illuminate\Http\Response
     */
    public function show(Constituency $constituency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Constituency  $constituency
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update location')) {
            $id = decrypt($encryptedID);

            $constituency = Constituency::findOrFail($id);

            // $county_id = $constituency->county_id;

            $counties = County::all(); // Example: Retrieve all counties for the dropdown menu

            // dd($roles);
            return view('admin.constituencies.edit', compact('constituency','counties'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Constituency  $constituency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('update location')) {

            $this->validate($request, [
                'name' => 'required|unique:constituencies,name,' . $id,
                'county_id' => 'required'
            ]);

            $constituency = Constituency::findOrFail($id);
            $constituency->name      = $request->name;
            $constituency->county_id      = $request->county_id;

            $constituency->touch();
            $constituency->save();

            return redirect()->route('constituency.index')->with('success', 'Constituency updated successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Constituency  $constituency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('delete location')) {

            $constituency = Constituency::findOrFail($id);
            $constituency->delete();

            return redirect()->route('constituency.index')->with('success', 'Constituency deleted successfully');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
