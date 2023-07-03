<?php

namespace App\Http\Controllers;

use App\Models\ApplicationPeriod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ApplicationPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage application period')) {

            $application_periods = ApplicationPeriod::latest()->paginate('10');

            return view('admin.application-period.index', compact('application_periods'));
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
        if (Auth::user()->can('create application period')) {
            return view('admin.application-period.create');
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
        if (Auth::user()->can('create application period')) {
            $this->validate($request, [
                'financial_year' => [
                    'required',
                    Rule::unique('application_periods')
                ],
                'period_from' => 'required',
                'period_to' => 'required',
                'status' => 'required',
            ]);

            $application                    = new ApplicationPeriod();
            $application->financial_year    = $request->financial_year;
            $application->period_from       = $request->period_from;
            $application->period_to         = $request->period_to;
            if ($request->status == 'Active') {
                $application->status      = '1';
            } else {
                $application->status      = '0';
            }

            $application->save();
            return redirect()->route('application-period.index')->with('success', 'New bursary application period created successfully.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApplicationPeriod  $applicationPeriod
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationPeriod $applicationPeriod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApplicationPeriod  $applicationPeriod
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedID)
    {
        if (Auth::user()->can('update application period')) {

            $id = decrypt($encryptedID);
            $applicationPeriod = ApplicationPeriod::findorFail($id);
            $financialYear = $applicationPeriod->financial_year;

            return view('admin.application-period.edit', compact('applicationPeriod', 'financialYear'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApplicationPeriod  $applicationPeriod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        if (Auth::user()->can('update application period')) {

            $application               = ApplicationPeriod::findorFail($id);


            $this->validate($request, [
                'financial_year' => 'required|unique:application_periods,financial_year,' . $application->id,
                'period_from' => 'required',
                'period_to' => 'required',
                'status' => 'required',
            ]);

            $application->financial_year    = $request->financial_year;
            $application->period_from       = $request->period_from;
            $application->period_to         = $request->period_to;
            if ($request->status == 'Active') {
                $application->status      = '1';
            } else {
                $application->status      = '0';
            }

            $application->save();

            return redirect()->route('application-period.index')->with('success', 'Bursary application period updated successfully.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApplicationPeriod  $applicationPeriod
     * @return \Illuminate\Http\Response
     */
    public function destroy($encryptedID)
    {
        if (Auth::user()->can('delete application period')) {

            $id = decrypt($encryptedID);

            $applicationPeriod = ApplicationPeriod::findorFail($id);

            $applicationPeriod->delete();

            return redirect()->route('application-period.index')->with('success', 'Application period deleted successfully.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
