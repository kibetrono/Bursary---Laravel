<?php

namespace App\Http\Controllers;

use App\Models\Bursary;
use App\Models\ApplicationPeriod;
use App\Models\Constituency;
use App\Models\County;
use App\Models\Location;
use App\Models\PollingStation;
use App\Models\SubLocation;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;


class BursaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage bursary')) {

            // show bursaries only when the user exist in Users tables
            // $bursaries = Bursary::join('users', 'users.id', '=', 'bursaries.user_id')
            // ->select('bursaries.*')
            // ->get();
            $user = auth()->user();

            if ($user->hasRole('super-admin')) {
                // Show data to super-admin
                $bursaries = Bursary::query()->latest()->paginate('10');
            } else {
                $bursaries = Bursary::where('status', '=', 0)->latest()->paginate('10');
            }
            $permissions = Permission::pluck('name')->all();

            return view('applicant.bursary.index', compact('bursaries', 'permissions'));
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
        $user = auth()->user();
        $currentYear = Carbon::now()->year;

        $applicationPeriodSet = ApplicationPeriod::where('financial_year', 'LIKE', '%' . $currentYear . '%')->first();

        $financialYear = explode('-', $applicationPeriodSet->financial_year)[0];

        $counties = County::all();
        $constituencies = Constituency::all();
        $wards = Ward::all();
        $locations = Location::all();
        $sublocations = SubLocation::all();
        $pollingstations = PollingStation::all();

        $result = ApplicationPeriod::isApplicationAllowed();
        $isAllowed = $result['allowed'];

        // Retrieve the system settings
        $applicationPeriod = ApplicationPeriod::first();

        if ($applicationPeriod && $isAllowed) {
            // Application is allowed
            // Your application logic here
            $applicationActive = true;

            $existingApplication = Bursary::where('user_id', $user->id)
                ->whereYear('created_at', $financialYear)
                ->exists();
        } else {
            // Application is not allowed
            // Show a message indicating that applications are not allowed at the moment

            $applicationActive = false;
            $existingApplication = false;
        }

        return view('applicant.bursary.create', compact('applicationActive', 'existingApplication', 'currentYear', 'counties','constituencies','wards','locations','sublocations','pollingstations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(encrypt(Auth::user()->id));
        // dd($request->all());
        $this->validate($request, [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'gender' => 'required',
            'id_or_passport_no' => 'nullable',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'institution_name' => 'required',
            'adm_or_reg_no' => 'required',
            'telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],
            'mode_of_study' => 'required',
            'year_of_study' => 'required',
            'course_name' => 'nullable',
            'county' => 'required',
            'constituency' => 'required',
            'ward' => 'required',
            'location' => 'required',
            'sub_location' => 'required',
            'polling_station' => 'required',
            'instititution_postal_address' => 'required',
            'instititution_telephone_number' => 'required',
            'total_fees_payable' => 'required',
            'total_fees_paid' => 'required',
            'fee_balance' => 'required',
            'bank_name' => 'required',
            'branch' => 'required',
            'account_number' => 'required',
            'parental_status' => 'required',
            'number_of_siblings' => 'required',
            'estimated_family_income' => 'required',

            'fathers_firstname' => 'nullable',
            'fathers_lastname' => 'nullable',
            'fathers_telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],
            'fathers_occupation' => 'nullable',
            'fathers_employment_type' => 'nullable',
            'mothers_firstname' => 'nullable',
            'mothers_lastname' => 'nullable',
            'mothers_telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],
            'mothers_occupation' => 'nullable',
            'mothers_employment_type' => 'nullable',
            'guardians_firstname' => 'nullable',
            'guardians_lastname' => 'nullable',
            'guardians_telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],

            'guardians_occupation' => 'nullable',
            'guardians_employment_type' => 'nullable',

            'transcript_report_form' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'parents_or_guardian_id' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'personal_id' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'birth_certificate' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'school_id' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'fathers_death_certificate' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'mothers_death_certificate' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            'current_fee_structure' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'admission_letter' => 'required|file|mimes:jpeg,png,pdf|max:2048',

        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {

            $user = auth()->user();

            $currentYear = Carbon::now()->year;

            $applicationPeriodSet = ApplicationPeriod::where('financial_year', 'LIKE', '%' . $currentYear . '%')->first();

            $financialYear = explode('-', $applicationPeriodSet->financial_year)[0];

            $existingApplication = Bursary::where('user_id', $user->id)
                ->whereYear('created_at', $financialYear)
                ->exists();

            if ($existingApplication) {
                return redirect()->back()->with('error', __('You have already submitted a bursary application for this financial year.'));
            }

            // dd($request->all());

            $bursary               = new Bursary();
            $bursary->user_id      = Auth::user()->id;
            $bursary->staff_id      = '0';
            $bursary->first_name      = $request->first_name;
            $bursary->last_name      = $request->last_name;
            $bursary->gender      = $request->gender;
            if ($request->has('id_or_passport_no') && $request['id_or_passport_no'] !== null) {
                $bursary->id_or_passport_no   = $request->id_or_passport_no;
            }
            $bursary->date_of_birth      = $request->date_of_birth;
            $bursary->institution_name      = $request->institution_name;
            $bursary->adm_or_reg_no      = $request->adm_or_reg_no;
            if ($request->has('telephone_number') && $request['telephone_number'] !== null) {
                $bursary->telephone_number   = $request->telephone_number;
            }
            $bursary->mode_of_study      = $request->mode_of_study;
            $bursary->year_of_study      = $request->year_of_study;
            if ($request->has('course_name') && $request['course_name'] !== null) {
                $bursary->course_name   = $request->course_name;
            }
            $bursary->county      = $request->county;
            $bursary->constituency      = $request->constituency;
            $bursary->location      = $request->location;
            $bursary->sub_location      = $request->sub_location;
            $bursary->ward      = $request->ward;
            $bursary->polling_station      = $request->polling_station;
            $bursary->instititution_postal_address      = $request->instititution_postal_address;
            $bursary->instititution_telephone_number      = $request->instititution_telephone_number;
            $bursary->total_fees_payable      = $request->total_fees_payable;
            $bursary->total_fees_paid      = $request->total_fees_paid;
            $bursary->fee_balance      = $request->fee_balance;
            $bursary->bank_name      = $request->bank_name;
            $bursary->branch      = $request->branch;
            $bursary->account_number      = "011222";
            $bursary->parental_status      = $request->parental_status;
            $bursary->number_of_siblings      = $request->number_of_siblings;
            $bursary->estimated_family_income      = $request->estimated_family_income;
            if ($request->has('fathers_firstname') && $request['fathers_firstname'] !== null) {
                $bursary->fathers_firstname   = $request->fathers_firstname;
            }
            if ($request->has('fathers_lastname') && $request['fathers_lastname'] !== null) {
                $bursary->fathers_lastname   = $request->fathers_lastname;
            }
            if ($request->has('fathers_telephone_number') && $request['fathers_telephone_number'] !== null) {
                $bursary->fathers_telephone_number   = $request->fathers_telephone_number;
            }
            if ($request->has('fathers_occupation') && $request['fathers_occupation'] !== null) {
                $bursary->fathers_occupation   = $request->fathers_occupation;
            }
            if ($request->has('fathers_employment_type') && $request['fathers_employment_type'] !== null) {
                $bursary->fathers_employment_type   = $request->fathers_employment_type;
            }
            if ($request->has('mothers_firstname') && $request['mothers_firstname'] !== null) {
                $bursary->mothers_firstname   = $request->mothers_firstname;
            }
            if ($request->has('mothers_lastname') && $request['mothers_lastname'] !== null) {
                $bursary->mothers_lastname   = $request->mothers_lastname;
            }
            if ($request->has('mothers_telephone_number') && $request['mothers_telephone_number'] !== null) {
                $bursary->mothers_telephone_number   = $request->mothers_telephone_number;
            }
            if ($request->has('mothers_occupation') && $request['mothers_occupation'] !== null) {
                $bursary->mothers_occupation   = $request->mothers_occupation;
            }
            if ($request->has('mothers_employment_type') && $request['mothers_employment_type'] !== null) {
                $bursary->mothers_employment_type   = $request->mothers_employment_type;
            }
            if ($request->has('guardians_firstname') && $request['guardians_firstname'] !== null) {
                $bursary->guardians_firstname   = $request->guardians_firstname;
            }
            if ($request->has('guardians_lastname') && $request['guardians_lastname'] !== null) {
                $bursary->guardians_lastname   = $request->guardians_lastname;
            }
            if ($request->has('guardians_telephone_number') && $request['guardians_telephone_number'] !== null) {
                $bursary->guardians_telephone_number   = $request->guardians_telephone_number;
            }
            if ($request->has('guardians_occupation') && $request['guardians_occupation'] !== null) {
                $bursary->guardians_occupation   = $request->guardians_occupation;
            }
            if ($request->has('guardians_employment_type') && $request['guardians_employment_type'] !== null) {
                $bursary->guardians_employment_type   = $request->guardians_employment_type;
            }

            $attachments = [];

            foreach ($request->allFiles() as $key => $file) {
                if ($request->hasFile($key)) {
                    // Generate a unique file name
                    $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

                    // Specify the file storage path
                    // $filePath = 'Attachments/' . $fileName;
                    $filePath = $fileName;

                    // Save the file to the desired location
                    $file->storeAs('public/attachments', $filePath);

                    // Add the file path to the attachments array
                    $attachments[$key] = $filePath;
                }
            }

            $bursary->transcript_report_form = $attachments['transcript_report_form'] ?? null;
            $bursary->parents_or_guardian_id = $attachments['parents_or_guardian_id'] ?? null;
            $bursary->personal_id = $attachments['personal_id'] ?? null;
            $bursary->birth_certificate = $attachments['birth_certificate'] ?? null;
            $bursary->school_id = $attachments['school_id'] ?? null;
            $bursary->fathers_death_certificate = $attachments['fathers_death_certificate'] ?? null;
            $bursary->mothers_death_certificate = $attachments['mothers_death_certificate'] ?? null;
            $bursary->current_fee_structure = $attachments['current_fee_structure'] ?? null;
            $bursary->admission_letter = $attachments['admission_letter'] ?? null;

            $bursary->status      = '0';

            $bursary->save();

            // Commit the transaction if everything is successful
            DB::commit();
            return redirect()->route('user.bursary.history', encrypt(Auth::user()->id))->with('success', 'Application sent successfully.');
        } catch (\Exception $e) {
            // An error occurred, so rollback the transaction
            DB::rollBack();
            return redirect()->route('user.bursary.create.form')->with('error', 'An error occured while saving the bursary application.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function show(Bursary $bursary)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function edit($encryptedId)
    {
        if (Auth::user()->can('edit bursary')) {

            $id = decrypt($encryptedId);
            $bursaryapplied = Bursary::findorFail($id);

            $counties = County::all();
            $constituencies = Constituency::all();
            $wards = Ward::all();
            $locations = Location::all();
            $subLocations = SubLocation::all();
            $pollingStations = PollingStation::all();

            return view('admin.bursary.edit', compact('bursaryapplied','counties','constituencies','wards','locations','subLocations','pollingStations'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit bursary')) {

            // $request->first_name;
            // dd($request->all());
            $this->validate($request, [
                'first_name' => 'required|max:120',
                'last_name' => 'required|max:120',
                'gender' => 'required',
                'id_or_passport_no' => 'nullable',
                'date_of_birth' => 'required|date_format:Y-m-d',
                'institution_name' => 'required',
                'adm_or_reg_no' => 'required',
                'telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],

                'mode_of_study' => 'required',
                'year_of_study' => 'required',
                'course_name' => 'nullable',
                'county' => 'required',
                'constituency' => 'required',
                'location' => 'required',
                'sub_location' => 'required',
                'ward' => 'required',
                'polling_station' => 'required',
                'instititution_postal_address' => 'required',
                'instititution_telephone_number' => 'required',
                'total_fees_payable' => 'required',
                'total_fees_paid' => 'required',
                'fee_balance' => 'required',
                'bank_name' => 'required',
                'branch' => 'required',
                'account_number' => 'required',
                'parental_status' => 'required',
                'number_of_siblings' => 'required',
                'estimated_family_income' => 'required',

                'fathers_firstname' => 'nullable',
                'fathers_lastname' => 'nullable',
                'fathers_telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],
                'fathers_occupation' => 'nullable',
                'fathers_employment_type' => 'nullable',
                'mothers_firstname' => 'nullable',
                'mothers_lastname' => 'nullable',
                'mothers_telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],
                'mothers_occupation' => 'nullable',
                'mothers_employment_type' => 'nullable',
                'guardians_firstname' => 'nullable',
                'guardians_lastname' => 'nullable',
                'guardians_telephone_number' => ['nullable', 'regex:/^(0|\+254|254)?-?[17]\d{2}-?\d{6}$/'],
                'guardians_occupation' => 'nullable',
                'guardians_employment_type' => 'nullable',

            ]);

            $bursary               = Bursary::findorFail($id);
            $originalValues = $bursary->getOriginal();
            // Compare the original values with the new values
            $changedFields = [];
            foreach ($request->all() as $key => $value) {
                if (array_key_exists($key, $originalValues) && $originalValues[$key] !== $value) {
                    $changedFields[$key] = $value;
                }
            }

            // Update only the changed fields
            $bursary->fill($changedFields);

            $bursary->touch(); // update updated_at filled
            // Save the bursary
            $bursary->save();


            return redirect()->route('bursary.index')->with('success', 'Application updated successfully.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function destroy($encryptedId)
    {
        if (Auth::user()->can('delete bursary')) {

            $id = decrypt($encryptedId);

            Bursary::findorFail($id)->delete();

            return redirect()->route('bursary.index')->with('success', 'Application deleted successfully.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function history($encryptedId)
    {
        $id = decrypt($encryptedId);

        $bursaries = Bursary::where('user_id', $id)->latest()->paginate('10');


        return view('applicant.bursary.history', compact('bursaries'));
    }


    public function approvedApplications(Request $request)
    {
        if (Auth::user()->can('manage bursary')) {

            $user = auth()->user();

            if ($user->hasRole('super-admin')) {
                // Show data to super-admin
                $approvedBursaries = Bursary::query()->where('status', '=', '1')->latest()->paginate('10');
            } else {
                $approvedBursaries = Bursary::query()->where('status', '=', '1')->where('staff_id', '=', $user->id)->latest()->paginate('10');
            }

            if ($request->has('approved_search')) {
                session()->put('approved_search', $request->approved_search);

                if ($user->hasRole('super-admin')) {
                    // Show data to super-admin
                    $approvedBursaries = Bursary::query()->where('adm_or_reg_no', 'like', "%{$request->approved_search}%")->where('status', '=', '1')->latest()->paginate('10');
                } else {
                    $approvedBursaries = Bursary::query()->where('adm_or_reg_no', 'like', "%{$request->approved_search}%")->where('status', '=', '1')->where('staff_id', '=', $user->id)->latest()->paginate('10');
                }

                $userSearch = session('approved_search');

                $approvedBursaries->appends(['approved_search' => $userSearch]);
            }

            return view('admin.bursary.approved', compact('approvedBursaries'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function approvedApplicationsSearch(Request $request, $encryptedId)
    {
        if (Auth::user()->can('manage bursary')) {

            $id = decrypt($encryptedId);

            $approvedBursaries = Bursary::where('staff_id', $id)->where('status', '=', '1')->get();

            if ($request->has('approved_search_by_staff')) {
                $approvedBursaries = Bursary::where('staff_id', $id)->where('adm_or_reg_no', 'like', "%{$request->approved_search}%")->where('status', '=', '1')->get();
            }

            $searchTerm = $request->approved_search;

            return view('admin.bursary.approved', compact('approvedBursaries', 'searchTerm'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function rejectedApplications(Request $request)
    {
        if (Auth::user()->can('manage bursary')) {

            $user = auth()->user();

            if ($user->hasRole('super-admin')) {

                // Show data to super-admin
                $rejectedBursaries = Bursary::query()->where('status', '=', '2')->latest()->paginate('10');
            } else {
                $rejectedBursaries = Bursary::query()->where('status', '=', '2')->where('staff_id', '=', $user->id)->latest()->paginate('10');
            }

            if ($request->has('rejected_search')) {
                session()->put('rejected_search', $request->rejected_search);

                if ($user->hasRole('super-admin')) {
                    // Show data to super-admin
                    $rejectedBursaries = Bursary::query()->where('adm_or_reg_no', 'like', "%{$request->rejected_search}%")->where('status', '=', '2')->latest()->paginate('10');
                } else {
                    $rejectedBursaries = Bursary::query()->where('adm_or_reg_no', 'like', "%{$request->rejected_search}%")->where('status', '=', '2')->where('staff_id', '=', $user->id)->latest()->paginate('10');
                }
                $userSearch = session('rejected_search');

                $rejectedBursaries->appends(['rejected_search' => $userSearch]);
            }

            return view('admin.bursary.rejected', compact('rejectedBursaries'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function updateApprovedBursaryStatus(Request $request): JsonResponse
    {
        $bursaryId = $request->input('bursaryId');

        // Retrieve the bursary by ID
        $bursary = Bursary::findOrFail($bursaryId);

        // Update the bursary status
        $bursary->status = 1; // Set the status to 1 (approved)
        $bursary->staff_id = Auth::user()->id; // Set the status to 1 (approved)
        $bursary->touch();
        $bursary->save();

        Session::flash('success', 'Application approved successfully');


        // Prepare the response data
        $data = [
            'url' => route('bursary.index'), // Provide the URL to redirect to
        ];

        // Return the JSON response
        return response()->json($data);
    }

    public function updateRejectedBursaryStatus(Request $request): JsonResponse
    {
        $bursaryId = $request->input('bursaryId');

        // Retrieve the bursary by ID
        $bursary = Bursary::findOrFail($bursaryId);

        // Update the bursary status
        $bursary->status = 2; // Set the status to 1 (approved)
        $bursary->staff_id = Auth::user()->id;
        $bursary->touch();
        $bursary->save();

        Session::flash('success', 'Application rejected successfully');


        // Prepare the response data
        $data = [
            'url' => route('bursary.index'), // Provide the URL to redirect to
        ];

        // Return the JSON response
        return response()->json($data);
    }

    // multi approve or reject
    public function multiApproveOrReject(Request $request)
    {
        // Retrieve the data from the AJAX request
        $action = $request->input('action');
        $ids = $request->input('ids');

        // Perform different actions based on the selected option
        if ($action === 'approve') {
            // Handle the 'approve' action
            DB::table('bursaries')
                ->whereIn('id', $ids)
                ->update(['status' => '1', 'staff_id' => Auth::user()->id, 'updated_at' => Carbon::now()]);
            Session::flash('success', 'Applications approved successfully');
            $data = ['url' => route('bursary.index')];
        } elseif ($action === 'reject') {
            // Handle the 'reject' action
            DB::table('bursaries')
                ->whereIn('id', $ids)
                ->update(['status' => '2', 'staff_id' => Auth::user()->id, 'updated_at' => Carbon::now()]);
            Session::flash('success', 'Applications rejected successfully');
            $data = ['url' => route('bursary.index')];
        }
        // elseif ($action === 'pending') {
        //     // Handle the 'reject' action
        //     DB::table('bursaries')
        //         ->whereIn('id', $ids)
        //         ->update(['status' => '0', 'staff_id' => '0', 'updated_at' => Carbon::now()]);
        //     Session::flash('success', 'Applications reverted successfully');
        //     $data = ['url' => route('bursary.index')];
        // } 
        else {
            Session::flash('error', 'An error occured.');
            $data = ['url' => route('bursary.index')];
        }

        // Return a response
        return response()->json($data);
    }

    public function downloadAttachment($filename)
    {
        // $filePath = public_path('Attachments/' . $file->filename);
        $filePath = storage_path('app/public/attachments/' . $filename);

        // dd($filePath);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
    
    public function fetchConstituencies($county)
    {
    
        // Retrieve locations based on the selected ward
        $constituencies = Constituency::where('county_name', $county)->get();

        return response()->json($constituencies);
    }

    public function fetchWards($constituency)
    {
        // Retrieve locations based on the selected ward
        $wards = Ward::where('constituency_name', $constituency)->get();

        return response()->json($wards);
    }

    public function fetchLocations($ward)
    {
    
        // Retrieve locations based on the selected ward
        $locations = Location::where('ward_name', $ward)->get();

        return response()->json($locations);
    }

    public function fetchSubLocations($location)
    {
        // Retrieve sub-locations based on the selected location
        $subLocations = SubLocation::where('location_name', $location)->get();

        return response()->json($subLocations);
    }

    public function fetchPollingStations($subLocation)
    {
        // Retrieve polling stations based on the selected sub-location
        $pollingStations = PollingStation::where('sublocation_name', $subLocation)->get();

        return response()->json($pollingStations);
    }

    
}
