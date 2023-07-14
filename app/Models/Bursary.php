<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bursary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'id_or_passport_no',
        'date_of_birth',
        'institution_name',
        'adm_or_reg_no',
        'telephone_number',
        'mode_of_study',
        'year_of_study',
        'course_name',
        'county',
        'constituency',
        'ward',
        'location',
        'sub_location',
        'polling_station',
        'instititution_postal_address',
        'instititution_telephone_number',
        'total_fees_payable',
        'total_fees_paid',
        'fee_balance',
        'bank_name',
        'branch',
        'account_number',
        'parental_status',
        'number_of_siblings',
        'estimated_family_income',
        'fathers_firstname',
        'fathers_lastname',
        'fathers_telephone_number',
        'fathers_occupation',
        'fathers_employment_type',
        'mothers_firstname',
        'mothers_lastname',
        'mothers_telephone_number',
        'mothers_occupation',
        'mothers_employment_type',
        'guardians_firstname',
        'guardians_lastname',
        'guardians_telephone_number',
        'guardians_occupation',
        'guardians_employment_type',
        'transcript_report_form',
        'parents_or_guardian_id',
        'personal_id',
        'birth_certificate',
        'school_id',
        'fathers_death_certificate',
        'mothers_death_certificate',
        'current_fee_structure',
        'admission_letter',
        'status'
    ];
}
