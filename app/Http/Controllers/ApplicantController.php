<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicationPeriod;
use App\Models\Bursary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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

        // $period_from = ApplicationPeriod

        $approvedApplications = Bursary::where('user_id', Auth::user()->id)->where('bursaries.status', '=', '1')->count();
        $rejectedApplications = Bursary::where('user_id', Auth::user()->id)->where('bursaries.status', '=', '2')->count();
        $pendingApplications = Bursary::where('user_id', Auth::user()->id)->where('bursaries.status', '=', '0')->count();
        $totalBursaryApplications = Bursary::where('user_id', Auth::user()->id)->count();

        $result = ApplicationPeriod::isApplicationAllowed();
        $isAllowed = $result['allowed'];

        // Retrieve the system settings
        $applicationPeriod = ApplicationPeriod::first();

        if ($applicationPeriod && $isAllowed) {
            // Application is allowed
            // Your application logic here
            $applicationActive = true;

            $periodFrom = $result['period_from'];
            $periodTo = $result['period_to'];
        } else {
            // Application is not allowed
            // Show a message indicating that applications are not allowed at the moment
            $applicationActive = false;
            $periodFrom = '';
            $periodTo = '';
        }

        return view('applicant.dashboard', compact('totalBursaryApplications', 'approvedApplications', 'rejectedApplications', 'pendingApplications', 'applicationStatuses', 'applicationActive', 'periodFrom', 'periodTo'));
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
