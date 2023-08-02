<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bursary;
use App\Models\Constituency;
use App\Models\County;
use App\Models\Location;
use App\Models\PollingStation;
use App\Models\SubLocation;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // code to draw chart to how  Top Ten Constituencies With Most Applicants 
        $constituencies = Constituency::orderBy('name')->pluck('name');
        $totalApplicants = Bursary::count();
        $chartData = collect([]);

        foreach ($constituencies as $constituency) {
            $applicantsCount = Bursary::whereHas('constituency', function ($query) use ($constituency) {
                $query->where('name', $constituency);
            })->count();

            $percentage = $totalApplicants > 0 ? round(($applicantsCount / $totalApplicants) * 100, 2) : 0;
            $chartData->push(['constituency' => $constituency, 'percentage' => $percentage]);
        }
        // end of code to draw chart to how  Top Ten Constituencies With Most Applicants 

        $roleName = 'Staff';

        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $staffCount = $role->users()->count();
        } else {
            $staffCount = 0;
        }

        $bursaryApplicationsCount = Bursary::all()->count();
        $approvedbursaryApplicationsCount = Bursary::where('bursaries.status', '=', '1')->count();
        $rejectedbursaryApplicationsCount = Bursary::where('bursaries.status', '=', '2')->count();
        $pendingbursaryApplicationsCount = Bursary::where('bursaries.status', '=', '0')->count();
        $totalRolesCount = Role::count();

        $countiesCount = County::all()->count();
        $constituenciesCount = Constituency::all()->count();
        $wardsCount = Ward::all()->count();
        $locationsCount = Location::all()->count();
        $sublocationsCount = SubLocation::all()->count();
        $pollingstationsCount = PollingStation::all()->count();

        // Approved Chart
        $startYear = Carbon::now()->subYears(10)->year;
        $endYear = Carbon::now()->year;

        $totalApplications = Bursary::select(DB::raw('COUNT(*) as count'), DB::raw('YEAR(created_at) as year'))
            ->whereYear('created_at', '>=', $startYear)
            ->whereYear('created_at', '<=', $endYear)
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();

        // dd($totalApplications);

        $approvedApplications = Bursary::select(DB::raw('COUNT(*) as count'), DB::raw('YEAR(created_at) as year'))
            ->where('status', 1)
            ->whereYear('created_at', '>=', $startYear)
            ->whereYear('created_at', '<=', $endYear)
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();

        $rejectedApplications = Bursary::select(DB::raw('COUNT(*) as count'), DB::raw('YEAR(created_at) as year'))
            ->where('status', 2)
            ->whereYear('created_at', '>=', $startYear)
            ->whereYear('created_at', '<=', $endYear)
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();


        $pendingApplications = Bursary::select(DB::raw('COUNT(*) as count'), DB::raw('YEAR(created_at) as year'))
            ->where('status', 0)
            ->whereYear('created_at', '>=', $startYear)
            ->whereYear('created_at', '<=', $endYear)
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();

        // dd($pendingApplications);


        // Fill in years with zero count if not present in the result
        for ($year = $startYear; $year <= $endYear; $year++) {

            if (!isset($totalApplications[$year])) {
                $totalApplications[$year] = 0;
            }
            if (!isset($approvedApplications[$year])) {
                $approvedApplications[$year] = 0;
            }
            if (!isset($rejectedApplications[$year])) {
                $rejectedApplications[$year] = 0;
            }
            if (!isset($pendingApplications[$year])) {
                $pendingApplications[$year] = 0;
            }
        }

        // Sort the result by year
        ksort($totalApplications);
        ksort($approvedApplications);
        ksort($rejectedApplications);
        ksort($pendingApplications);

        // Calculate the percentage of approved,rejected and pending applications
        $approvalPercentages = [];
        $rejectralPercentages = [];
        $pendralPercentages = [];
        foreach ($totalApplications as $year => $total) {
            // for approved
            $approvedY = $approvedApplications[$year];
            $approved_percentage = ($total > 0) ? ($approvedY / $total) * 100 : 0;
            $approvalPercentages[$year] = round($approved_percentage, 2);
            // for rejected
            $rejectedY = $rejectedApplications[$year];
            $rejected_percentage = ($total > 0) ? ($rejectedY / $total) * 100 : 0;
            $rejectralPercentages[$year] = round($rejected_percentage, 2);
            // for pending
            $pendingY = $pendingApplications[$year];
            $pending_percentage = ($total > 0) ? ($pendingY / $total) * 100 : 0;
            $pendralPercentages[$year] = round($pending_percentage, 2);
        }


        return view('admin.dashboard', compact('staffCount', 'bursaryApplicationsCount', 'totalApplications', 'approvalPercentages', 'rejectralPercentages', 'pendralPercentages', 'approvedbursaryApplicationsCount', 'rejectedbursaryApplicationsCount', 'pendingbursaryApplicationsCount', 'totalRolesCount', 'countiesCount', 'constituenciesCount', 'wardsCount', 'locationsCount', 'sublocationsCount', 'pollingstationsCount', 'chartData'));
    }

    public function list()
    {
        return view('admin.admin.list');
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
