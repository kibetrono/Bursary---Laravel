<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Bursary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicationStatuses = DB::table('bursaries')
            ->select(
                DB::raw('CASE
                            WHEN status = 1 THEN "Approved"
                            WHEN status = 2 THEN "Rejected"
                            WHEN status = 0 THEN "Pending"
                            ELSE "Unknown"
                        END as status'),
                DB::raw('COUNT(CASE WHEN status = 1 THEN 1 END) as approved'),
                DB::raw('COUNT(CASE WHEN status = 2 THEN 1 END) as rejected'),
                DB::raw('COUNT(CASE WHEN status = 0 THEN 1 END) as pending'),
                DB::raw('COUNT(*) as total')
            )
            ->where('user_id', Auth::user()->id)
            ->groupBy('status')
            ->get();

        // Retrieve the data from the database
        $applicationTimeline = DB::table('bursaries')
            ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS total'))
            ->where('user_id', Auth::user()->id)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $dates = [];
        $totals = [];

        // Format dates and calculate percentages
        $totalApplications = 0;
        foreach ($applicationTimeline as $entry) {
            $dates[] = $entry->date;
            $totalApplications += $entry->total;
        }

        foreach ($applicationTimeline as $entry) {
            $percentage = ($entry->total / $totalApplications) * 100;
            $totals[] = round($percentage, 2);
        }


        $approvedApplications = Bursary::where('user_id', Auth::user()->id)->where('bursaries.status', '=', '1')->count();
        $rejectedApplications = Bursary::where('user_id', Auth::user()->id)->where('bursaries.status', '=', '2')->count();

        return view('applicant.dashboard', compact('approvedApplications', 'rejectedApplications', 'applicationStatuses', 'dates', 'totals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
