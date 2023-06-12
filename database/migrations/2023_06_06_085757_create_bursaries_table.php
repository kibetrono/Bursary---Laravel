<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBursariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bursaries', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->integer('id_or_passport_no')->nullable();
            $table->timestamp('date_of_birth');
            $table->string('institution_name');
            $table->string('adm_or_reg_no');
            $table->string('telephone_number')->nullable();
            $table->string('mode_of_study');
            $table->integer('year_of_study');
            $table->string('course_name')->nullable();
            $table->string('location');
            $table->string('sub_location');
            $table->string('ward');
            $table->string('polling_station');
            $table->string('instititution_postal_address');
            $table->string('instititution_telephone_number');
            $table->decimal('total_fees_payable', 10, 2);
            $table->decimal('total_fees_paid', 10, 2);
            $table->decimal('fee_balance', 10, 2);
            $table->string('bank_name');
            $table->string('branch');
            $table->bigInteger('account_number');
            $table->string('parental_status');
            $table->integer('number_of_siblings');
            $table->decimal('estimated_family_income',10,2);
            $table->string('fathers_firstname')->nullable();
            $table->string('fathers_lastname')->nullable();
            $table->string('fathers_telephone_number')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->string('fathers_employment_type')->nullable();
            $table->string('mothers_firstname')->nullable();
            $table->string('mothers_lastname')->nullable();
            $table->string('mothers_telephone_number')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->string('mothers_employment_type')->nullable();
            $table->string('guardians_firstname')->nullable();
            $table->string('guardians_lastname')->nullable();
            $table->string('guardians_telephone_number')->nullable();
            $table->string('guardians_occupation')->nullable();
            $table->string('guardians_employment_type')->nullable();

            $table->string('transcript_report_form');
            $table->string('parents_or_guardian_id');
            $table->string('personal_id')->nullable();
            $table->string('birth_certificate');
            $table->string('school_id')->nullable();
            $table->string('fathers_death_certificate')->nullable();
            $table->string('mothers_death_certificate')->nullable();
            $table->string('current_fee_structure');
            $table->string('admission_letter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bursaries');
    }
}
