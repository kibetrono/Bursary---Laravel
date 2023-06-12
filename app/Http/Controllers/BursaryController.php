<?php

namespace App\Http\Controllers;

use App\Models\Bursary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BursaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bursaries = Bursary::latest()->get();
        return view('applicant.bursary.index',compact('bursaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applicant.bursary.create');
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
        $this->validate($request, [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'gender' => 'required',
            'id_or_passport_no' => 'nullable',
            'date_of_birth' => 'required',
            'institution_name' => 'required',
            'adm_or_reg_no' => 'required',
            'telephone_number' => 'nullable',
            'mode_of_study' => 'required',
            'year_of_study' => 'required',
            'course_name' => 'nullable',
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
            'fathers_telephone_number' => 'nullable',
            'fathers_occupation' => 'nullable',
            'fathers_employment_type' => 'nullable',
            'mothers_firstname' => 'nullable',
            'mothers_lastname' => 'nullable',
            'mothers_telephone_number' => 'nullable',
            'mothers_occupation' => 'nullable',
            'mothers_employment_type' => 'nullable',
            'guardians_firstname' => 'nullable',
            'guardians_lastname' => 'nullable',
            'guardians_telephone_number' => 'nullable',
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

        $bursary               = new Bursary();
        $bursary->user_id      = Auth::user()->id;
        $bursary->first_name      = $request->first_name;
        $bursary->last_name      = $request->last_name;
        $bursary->gender      = $request->gender;
        if($request->has('id_or_passport_no') && $request['id_or_passport_no'] !== null){
            $bursary->id_or_passport_no   = $request->id_or_passport_no;
        }
        $bursary->date_of_birth      = $request->date_of_birth;
        $bursary->institution_name      = $request->institution_name;
        $bursary->adm_or_reg_no      = $request->adm_or_reg_no;
        if($request->has('telephone_number') && $request['telephone_number'] !== null){
            $bursary->telephone_number   = $request->telephone_number;
        }
        $bursary->mode_of_study      = $request->mode_of_study;
        $bursary->year_of_study      = $request->year_of_study;
        if($request->has('course_name') && $request['course_name'] !== null){
            $bursary->course_name   = $request->course_name;
        }
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
        if($request->has('fathers_firstname') && $request['fathers_firstname'] !== null){
            $bursary->fathers_firstname   = $request->fathers_firstname;
        }
        if($request->has('fathers_lastname') && $request['fathers_lastname'] !== null){
            $bursary->fathers_lastname   = $request->fathers_lastname;
        }
        if($request->has('fathers_telephone_number') && $request['fathers_telephone_number'] !== null){
            $bursary->fathers_telephone_number   = $request->fathers_telephone_number;
        }
        if($request->has('fathers_occupation') && $request['fathers_occupation'] !== null){
            $bursary->fathers_occupation   = $request->fathers_occupation;
        }
        if($request->has('fathers_employment_type') && $request['fathers_employment_type'] !== null){
            $bursary->fathers_employment_type   = $request->fathers_employment_type;
        }
        if($request->has('mothers_firstname') && $request['mothers_firstname'] !== null){
            $bursary->mothers_firstname   = $request->mothers_firstname;
        }
        if($request->has('mothers_lastname') && $request['mothers_lastname'] !== null){
            $bursary->mothers_lastname   = $request->mothers_lastname;
        }
        if($request->has('mothers_telephone_number') && $request['mothers_telephone_number'] !== null){
            $bursary->mothers_telephone_number   = $request->mothers_telephone_number;
        }
        if($request->has('mothers_occupation') && $request['mothers_occupation'] !== null){
            $bursary->mothers_occupation   = $request->mothers_occupation;
        }
        if($request->has('mothers_employment_type') && $request['mothers_employment_type'] !== null){
            $bursary->mothers_employment_type   = $request->mothers_employment_type;
        }
        if($request->has('guardians_firstname') && $request['guardians_firstname'] !== null){
            $bursary->guardians_firstname   = $request->guardians_firstname;
        }
        if($request->has('guardians_lastname') && $request['guardians_lastname'] !== null){
            $bursary->guardians_lastname   = $request->guardians_lastname;
        }
        if($request->has('guardians_telephone_number') && $request['guardians_telephone_number'] !== null){
            $bursary->guardians_telephone_number   = $request->guardians_telephone_number;
        }
        if($request->has('guardians_occupation') && $request['guardians_occupation'] !== null){
            $bursary->guardians_occupation   = $request->guardians_occupation;
        }
        if($request->has('guardians_employment_type') && $request['guardians_employment_type'] !== null){
            $bursary->guardians_employment_type   = $request->guardians_employment_type;
        }
        $bursary->transcript_report_form      = $request->transcript_report_form;
        $bursary->parents_or_guardian_id      = $request->parents_or_guardian_id;
        if($request->has('personal_id') && $request['personal_id'] !== null){
            $bursary->personal_id   = $request->personal_id;
        }
        $bursary->birth_certificate      = $request->birth_certificate;
        if($request->has('school_id') && $request['school_id'] !== null){
            $bursary->school_id   = $request->school_id;
        }
        if($request->has('fathers_death_certificate') && $request['fathers_death_certificate'] !== null){
            $bursary->fathers_death_certificate   = $request->fathers_death_certificate;
        }
        if($request->has('mothers_death_certificate') && $request['mothers_death_certificate'] !== null){
            $bursary->mothers_death_certificate   = $request->mothers_death_certificate;
        }
        $bursary->current_fee_structure      = $request->current_fee_structure;
        $bursary->admission_letter      = $request->admission_letter;
        $bursary->status      = '0';
        
        $bursary->save();

        return redirect()->route('user.bursary.history',encrypt(Auth::user()->id))->with('success','Application sent successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function show(Bursary $bursary)
    {
        dd('ddddddddd');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function edit(Bursary $bursary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bursary $bursary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bursary  $bursary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bursary $bursary)
    {
        //
    }
    public function history($encryptedId)
    {   
        $id = decrypt($encryptedId);
       
        $bursaries = Bursary::where('user_id',$id)->get();
        
        return view('applicant.bursary.history',compact('bursaries'));
    }

    public function showToAttendees($encryptedId)
    {
        $id = decrypt($encryptedId);
        $data = Bursary::findorFail($id);
        
        return view('admin.bursary.show',compact('data'));
    }

    public function approvedApplications()
    {
        return view('admin.bursary.approved');
    }

    public function rejectedApplications()
    {
        return view('admin.bursary.rejected');
    }
    // download attachments
    
}
