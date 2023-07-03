@extends('layouts.app')

@section('title')
    Apply Bursary
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    {{-- /select 2 --}}

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/bursary/create.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Apply Bursary</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Apply Bursary</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @include('layouts.flash-messages')
                    </div>

                </div>
            </div><!-- /.container-fluid -->

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Apply Bursary</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->

                            @if ($applicationActive)
                                <!-- Step Indicator -->
                                <div class="step-indicator pt-3 px-4">
                                    <div class="step">
                                        <div class="step-number">1</div>
                                        <div class="step-title">Personal Details</div>
                                    </div>
                                    <div class="step">
                                        <div class="step-number">2</div>
                                        <div class="step-title">Family Background Information</div>
                                    </div>
                                    <div class="step">
                                        <div class="step-number">3</div>
                                        <div class="step-title">Address Information</div>
                                    </div>
                                    <div class="step">
                                        <div class="step-number">4</div>
                                        <div class="step-title">School Information</div>
                                    </div>
                                    <div class="step">
                                        <div class="step-number">5</div>
                                        <div class="step-title">Key Attachments</div>
                                    </div>
                                </div>


                                <!-- form start -->
                                <div class="card-body pt-0">
                                    <form id="application_form" action="{{ route('user.bursary.store') }}"
                                        class="bursary-form" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        {{-- Personal Information --}}
                                        <div class="form-section">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group first_name required">
                                                        <label class="control-label" for="first_name">First Name:</label>
                                                        <input type="text" id="first_name"
                                                            class="form-control @error('first_name') is-invalid @enderror"
                                                            name="first_name" aria-required="true" placeholder="First name"
                                                            required>
                                                        @error('first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group last_name required">
                                                        <label class="control-label" for="last_name">Last Name:</label>
                                                        <input type="text" id="last_name"
                                                            class="form-control @error('last_name') is-invalid @enderror"
                                                            name="last_name" aria-required="true" placeholder="Last name"
                                                            required>
                                                        @error('last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group gender required">
                                                        <label class="control-label" for="gender">Gender:</label>
                                                        <select id="gender" name="gender"
                                                            class="form-control @error('gender') is-invalid @enderror"
                                                            required>
                                                            <option value="" selected disabled>Select gender</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="others">Others</option>
                                                        </select>
                                                        @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group id_or_passport_no required">
                                                        <label class="control-label" for="id_or_passport_no">ID/Passport
                                                            no.:</label>
                                                        <input type="number" id="id_or_passport_no"
                                                            class="form-control @error('id_or_passport_no') is-invalid @enderror"
                                                            name="id_or_passport_no" aria-required="true"
                                                            placeholder="ID or passport number">
                                                        @error('id_or_passport_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group date_of_birth required">
                                                        <label class="control-label" for="date_of_birth">Date of
                                                            Birth:</label>
                                                        <input type="date" id="date_of_birth"
                                                            class="form-control @error('date_of_birth') is-invalid @enderror"
                                                            name="date_of_birth" aria-required="true" required>
                                                        @error('date_of_birth')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group telephone_number required">
                                                        <label class="control-label" for="telephone_number">Telephone
                                                            Number:</label>
                                                        <input type="text" id="telephone_number"
                                                            class="form-control @error('telephone_number') is-invalid @enderror"
                                                            name="telephone_number" aria-required="true"
                                                            placeholder="Telephone number">
                                                        @error('telephone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div> {{-- end of row --}}
                                        </div>
                                        {{-- /Personal Information --}}

                                        {{-- /Family Information --}}
                                        <div class="form-section">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group parental_status required">
                                                        <label class="control-label" for="parental_status">Parental
                                                            Status:</label>
                                                        <select id="parental_status" name="parental_status"
                                                            class="form-control @error('parental_status') is-invalid @enderror"
                                                            required>
                                                            <option value="" selected disabled>Select parental status
                                                            </option>
                                                            <option value="Single Parent">Single Parent</option>
                                                            <option value="One Parent Dead">One Parent Dead</option>
                                                            <option value="Both Parents Dead">Both Parents Dead</option>
                                                            <option value="Both Parents Alive">Both Parents Alive</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                        @error('parental_status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group number_of_siblings required">
                                                        <label class="control-label" for="number_of_siblings">Number of
                                                            Siblings:</label>
                                                        <input type="number" id="number_of_siblings"
                                                            class="form-control @error('number_of_siblings') is-invalid @enderror"
                                                            name="number_of_siblings" aria-required="true"
                                                            placeholder="Number of siblings" required>
                                                        @error('number_of_siblings')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group estimated_family_income required">
                                                        <label class="control-label"
                                                            for="estimated_family_income">Estimated
                                                            Family Income:</label>
                                                        <input type="number" id="estimated_family_income"
                                                            class="form-control @error('estimated_family_income') is-invalid @enderror"
                                                            name="estimated_family_income" aria-required="true"
                                                            placeholder="Family income(yearly)" required>
                                                        @error('estimated_family_income')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h6><b>Father's Information:</b></h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group fathers_firstname required">
                                                        <label class="control-label" for="fathers_firstname">First
                                                            Name:</label>
                                                        <input type="text" id="fathers_firstname"
                                                            class="form-control @error('fathers_firstname') is-invalid @enderror"
                                                            name="fathers_firstname" aria-required="true"
                                                            placeholder="Father's firstname">
                                                        @error('fathers_firstname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group fathers_lastname required">
                                                        <label class="control-label" for="fathers_lastname">Last
                                                            Name:</label>
                                                        <input type="text" id="fathers_lastname"
                                                            class="form-control @error('fathers_lastname') is-invalid @enderror"
                                                            name="fathers_lastname" aria-required="true"
                                                            placeholder="Father's lastname">
                                                        @error('fathers_lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group fathers_telephone_number required">
                                                        <label class="control-label"
                                                            for="fathers_telephone_number">Telephone
                                                            Number:</label>
                                                        <input type="number" id="fathers_telephone_number"
                                                            class="form-control @error('fathers_telephone_number') is-invalid @enderror"
                                                            name="fathers_telephone_number" aria-required="true"
                                                            placeholder="Father's phone number">
                                                        @error('fathers_telephone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group fathers_occupation required">
                                                        <label class="control-label"
                                                            for="fathers_occupation">Occupation:</label>
                                                        <input type="text" id="fathers_occupation"
                                                            class="form-control @error('fathers_occupation') is-invalid @enderror"
                                                            name="fathers_occupation" aria-required="true"
                                                            placeholder="Father's occupation">
                                                        @error('fathers_occupation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group fathers_employment_type required">
                                                        <label class="control-label"
                                                            for="fathers_employment_type">Employment
                                                            Type:</label>
                                                        <select id="fathers_employment_type"
                                                            name="fathers_employment_type"
                                                            class="form-control @error('fathers_employment_type') is-invalid @enderror">
                                                            <option value="" selected disabled>Select father's
                                                                employment
                                                                type</option>
                                                            <option value="permanent">Permanent</option>
                                                            <option value="contractual">Contractual</option>
                                                            <option value="casual">Casual</option>
                                                            <option value="retired">Retired</option>
                                                            <option value="self_employed">Self Employed</option>
                                                        </select>
                                                        @error('fathers_employment_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <h6><b>Mother's Information:</b></h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mothers_firstname required">
                                                        <label class="control-label" for="mothers_firstname">First
                                                            Name:</label>
                                                        <input type="text" id="mothers_firstname"
                                                            class="form-control @error('mothers_firstname') is-invalid @enderror"
                                                            name="mothers_firstname" aria-required="true"
                                                            placeholder="Mother's firstname">
                                                        @error('mothers_firstname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mothers_lastname required">
                                                        <label class="control-label" for="mothers_lastname">Last
                                                            Name:</label>
                                                        <input type="text" id="mothers_lastname"
                                                            class="form-control @error('mothers_lastname') is-invalid @enderror"
                                                            name="mothers_lastname" aria-required="true"
                                                            placeholder="Mother's lastname">
                                                        @error('mothers_lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mothers_telephone_number required">
                                                        <label class="control-label"
                                                            for="mothers_telephone_number">Telephone
                                                            Number:</label>
                                                        <input type="number" id="mothers_telephone_number"
                                                            class="form-control @error('mothers_telephone_number') is-invalid @enderror"
                                                            name="mothers_telephone_number" aria-required="true"
                                                            placeholder="Mother's phone number">
                                                        @error('mothers_telephone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mothers_occupation required">
                                                        <label class="control-label"
                                                            for="mothers_occupation">Occupation:</label>
                                                        <input type="text" id="mothers_occupation"
                                                            class="form-control @error('mothers_occupation') is-invalid @enderror"
                                                            name="mothers_occupation" aria-required="true"
                                                            placeholder="Mother's occupation">
                                                        @error('mothers_occupation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group mothers_employment_type required">
                                                        <label class="control-label"
                                                            for="mothers_employment_type">Employment
                                                            Type:</label>
                                                        <select id="mothers_employment_type"
                                                            name="mothers_employment_type"
                                                            class="form-control @error('mothers_employment_type') is-invalid @enderror">
                                                            <option value="" selected disabled>Select Mother's
                                                                employment
                                                                type</option>
                                                            <option value="permanent">Permanent</option>
                                                            <option value="contractual">Contractual</option>
                                                            <option value="casual">Casual</option>
                                                            <option value="retired">Retired</option>
                                                            <option value="self_employed">Self Employed</option>
                                                        </select>
                                                        @error('mothers_employment_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <h6><b>Guardian's Information:</b></h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group guardians_firstname required">
                                                        <label class="control-label" for="guardians_firstname">First
                                                            Name:</label>
                                                        <input type="text" id="guardians_firstname"
                                                            class="form-control @error('guardians_firstname') is-invalid @enderror"
                                                            name="guardians_firstname" aria-required="true"
                                                            placeholder="Guardian's firstname">
                                                        @error('guardians_firstname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group guardians_lastname required">
                                                        <label class="control-label" for="guardians_lastname">Last
                                                            Name:</label>
                                                        <input type="text" id="guardians_lastname"
                                                            class="form-control @error('guardians_lastname') is-invalid @enderror"
                                                            name="guardians_lastname" aria-required="true"
                                                            placeholder="Guardian's lastname">
                                                        @error('guardians_lastname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group guardians_telephone_number required">
                                                        <label class="control-label"
                                                            for="guardians_telephone_number">Telephone
                                                            Number:</label>
                                                        <input type="number" id="guardians_telephone_number"
                                                            class="form-control @error('guardians_telephone_number') is-invalid @enderror"
                                                            name="guardians_telephone_number" aria-required="true"
                                                            placeholder="Guardian's phone number">
                                                        @error('guardians_telephone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group guardians_occupation required">
                                                        <label class="control-label"
                                                            for="guardians_occupation">Occupation:</label>
                                                        <input type="text" id="guardians_occupation"
                                                            class="form-control @error('guardians_occupation') is-invalid @enderror"
                                                            name="guardians_occupation" aria-required="true"
                                                            placeholder="Guardian's occupation">
                                                        @error('guardians_occupation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group guardians_employment_type required">
                                                        <label class="control-label"
                                                            for="guardians_employment_type">Employment
                                                            Type:</label>
                                                        <select id="guardians_employment_type"
                                                            name="guardians_employment_type"
                                                            class="form-control @error('guardians_employment_type') is-invalid @enderror">
                                                            <option value="" selected disabled>Select Guardian's
                                                                employment
                                                                type</option>
                                                            <option value="permanent">Permanent</option>
                                                            <option value="contractual">Contractual</option>
                                                            <option value="casual">Casual</option>
                                                            <option value="retired">Retired</option>
                                                            <option value="self_employed">Self Employed</option>
                                                        </select>
                                                        @error('guardians_employment_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- /Family Information --}}

                                        {{-- /Address Information --}}
                                        <div class="form-section">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group location required">
                                                        <label class="control-label" for="location">Location:</label>
                                                        <input type="text" id="location"
                                                            class="form-control @error('location') is-invalid @enderror"
                                                            name="location" aria-required="true"
                                                            placeholder="Location name" required>
                                                        @error('location')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group sub_location required">
                                                        <label class="control-label" for="sub_location">Sub
                                                            Location:</label>
                                                        <input type="text" id="sub_location"
                                                            class="form-control @error('sub_location') is-invalid @enderror"
                                                            name="sub_location" aria-required="true"
                                                            placeholder="sub location" required>
                                                        @error('sub_location')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ward required">
                                                        <label class="control-label" for="ward">Ward:</label>
                                                        <input type="text" id="ward"
                                                            class="form-control @error('ward') is-invalid @enderror"
                                                            name="ward" aria-required="true" placeholder="Ward name"
                                                            required>
                                                        @error('ward')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group polling_station required">
                                                        <label class="control-label" for="polling_station">Polling
                                                            station:</label>
                                                        <input type="text" id="polling_station"
                                                            class="form-control @error('polling_station') is-invalid @enderror"
                                                            name="polling_station" aria-required="true"
                                                            placeholder="Polling station" required>
                                                        @error('polling_station')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- /Address Information --}}

                                        {{-- /School Information --}}
                                        <div class="form-section">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group institution_name required">
                                                        <label class="control-label" for="date_of_birth">Name of
                                                            school/college/university:</label>
                                                        <input type="text" id="institution_name"
                                                            class="form-control @error('institution_name') is-invalid @enderror"
                                                            name="institution_name" aria-required="true"
                                                            placeholder="School name" required>
                                                        @error('institution_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group adm_or_reg_no required">
                                                        <label class="control-label"
                                                            for="adm_or_reg_no">Admission/Registration
                                                            no.:</label>
                                                        <input type="text" id="adm_or_reg_no"
                                                            class="form-control @error('adm_or_reg_no') is-invalid @enderror"
                                                            name="adm_or_reg_no" aria-required="true"
                                                            placeholder="Admission or registration number" required>
                                                        @error('adm_or_reg_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group mode_of_study required">
                                                        <label class="control-label" for="mode_of_study">Study
                                                            Mode:</label>
                                                        <select id="mode_of_study" name="mode_of_study"
                                                            class="form-control @error('mode_of_study') is-invalid @enderror"
                                                            required>
                                                            <option value="" selected disabled>Select study mode
                                                            </option>
                                                            <option value="day">Day</option>
                                                            <option value="boarding">Boarding</option>
                                                            <option value="regular">Regular</option>
                                                            <option value="parallel">Parallel</option>
                                                        </select>
                                                        @error('mode_of_study')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group year_of_study required">
                                                        <label class="control-label" for="year_of_study">Grade/Class/Year
                                                            of
                                                            Study:</label>
                                                        <input type="number" id="year_of_study"
                                                            class="form-control @error('year_of_study') is-invalid @enderror"
                                                            name="year_of_study" aria-required="true"
                                                            placeholder="Grade/class/year of study" required>
                                                        @error('year_of_study')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group course_name required">
                                                        <label class="control-label" for="course_name">Course(tertiary
                                                            institution
                                                            and University):</label>
                                                        <input type="text" id="course_name"
                                                            class="form-control @error('course_name') is-invalid @enderror"
                                                            name="course_name" aria-required="true"
                                                            placeholder="Course name">
                                                        @error('course_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>



                                                <div class="col-md-4">
                                                    <div class="form-group instititution_postal_address required">
                                                        <label class="control-label"
                                                            for="instititution_postal_address">Institution's Postal
                                                            Address:</label>
                                                        <input type="text" id="instititution_postal_address"
                                                            class="form-control @error('instititution_postal_address') is-invalid @enderror"
                                                            name="instititution_postal_address" aria-required="true"
                                                            placeholder="Institution's postal address" required>
                                                        @error('instititution_postal_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group instititution_telephone_number required">
                                                        <label class="control-label"
                                                            for="instititution_telephone_number">Institution's Telephone
                                                            Number:</label>
                                                        <input type="text" id="instititution_telephone_number"
                                                            class="form-control @error('instititution_telephone_number') is-invalid @enderror"
                                                            name="instititution_telephone_number" aria-required="true"
                                                            placeholder="Institution's telephone number" required>
                                                        @error('instititution_telephone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <p><b>Fees Payable:</b></p>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group total_fees_payable required">
                                                        <label class="control-label" for="total_fees_payable">Total Fees
                                                            Payable:</label>
                                                        <input type="number" id="total_fees_payable"
                                                            class="form-control @error('total_fees_payable') is-invalid @enderror"
                                                            name="total_fees_payable" aria-required="true"
                                                            placeholder="Total fees payable" required>
                                                        @error('total_fees_payable')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group total_fees_paid required">
                                                        <label class="control-label" for="total_fees_paid">Total Fees
                                                            Paid:</label>
                                                        <input type="number" id="total_fees_paid"
                                                            class="form-control @error('total_fees_paid') is-invalid @enderror"
                                                            name="total_fees_paid" aria-required="true"
                                                            placeholder="Total amount paid" required>
                                                        @error('total_fees_paid')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group fee_balance required">
                                                        <label class="control-label" for="fee_balance">Fee
                                                            Balance:</label>
                                                        <input type="number" id="fee_balance"
                                                            class="form-control @error('fee_balance') is-invalid @enderror"
                                                            name="fee_balance" aria-required="true"
                                                            placeholder="Balance amount" required>
                                                        @error('fee_balance')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <p><b>School/College/University Account Details:</b></p>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group bank_name required">
                                                        <label class="control-label" for="bank_name">Name of Bank:</label>
                                                        <select id="bank_name" name="bank_name"
                                                            class="form-control @error('bank_name') is-invalid @enderror"
                                                            required>
                                                            <option value="" selected disabled>Select bank name
                                                            </option>
                                                            <option value="Equity Bank">Equity Bank</option>
                                                            <option value="KCB Bank (Kenya Commercial Bank)">KCB Bank
                                                                (Kenya Commercial Bank)</option>
                                                            <option value="Cooperative Bank of Kenya">Cooperative Bank of
                                                                Kenya</option>
                                                            <option value="Barclays Bank of Kenya (Absa Bank Kenya PLC)">
                                                                Barclays Bank of Kenya (Absa Bank Kenya PLC)</option>
                                                            <option value="Standard Chartered Bank Kenya">Standard
                                                                Chartered Bank Kenya</option>
                                                            <option value="CFC Stanbic Bank (Stanbic Bank Kenya)">CFC
                                                                Stanbic Bank (Stanbic Bank Kenya)</option>
                                                            <option value="Diamond Trust Bank Kenya">Diamond Trust Bank
                                                                Kenya</option>
                                                            <option value="National Bank of Kenya">National Bank of Kenya
                                                            </option>
                                                            <option value="NIC Bank (Now part of NCBA Bank)">NIC Bank (Now
                                                                part of NCBA Bank)</option>
                                                            <option
                                                                value="Commercial Bank of Africa (CBA) - Merged with NIC Bank to form NCBA Bank">
                                                                Commercial Bank of Africa (CBA) - Merged with NIC Bank to
                                                                form NCBA Bank</option>
                                                            <option value="I&M Bank Kenya">I&M Bank Kenya</option>
                                                            <option value="Ecobank Kenya">Ecobank Kenya</option>
                                                            <option value="Bank of Africa Kenya">Bank of Africa Kenya
                                                            </option>
                                                            <option value="Family Bank Kenya">Family Bank Kenya</option>
                                                            <option value="Gulf African Bank">Gulf African Bank</option>
                                                            <option value="Credit Bank Kenya">Credit Bank Kenya</option>
                                                            <option value="Prime Bank Kenya">Prime Bank Kenya</option>
                                                            <option value="Sidian Bank (formerly K-Rep Bank)">Sidian Bank
                                                                (formerly K-Rep Bank)</option>
                                                            <option value="Victoria Commercial Bank">Victoria Commercial
                                                                Bank</option>
                                                            <option value="Housing Finance Company of Kenya">Housing
                                                                Finance Company of Kenya</option>
                                                            <option
                                                                value="Chase Bank Kenya (Currently under receivership)">
                                                                Chase Bank Kenya (Currently under receivership)</option>

                                                        </select>
                                                        @error('bank_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group branch required">
                                                        <label class="control-label" for="branch">Branch:</label>
                                                        <input type="text" id="branch"
                                                            class="form-control @error('branch') is-invalid @enderror"
                                                            name="branch" aria-required="true" placeholder="Branch"
                                                            required>
                                                        @error('branch')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group account_number required">
                                                        <label class="control-label" for="account_number">Account
                                                            Number:</label>
                                                        <input type="number" id="account_number"
                                                            class="form-control @error('account_number') is-invalid @enderror"
                                                            name="account_number" aria-required="true"
                                                            placeholder="Account number" required>
                                                        @error('account_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- /School Information --}}

                                        {{-- /Key Attachments --}}
                                        <div class="form-section">
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group transcript_report_form required">
                                                        <label class="control-label" for="transcript_report_form">Recent
                                                            Transcipt/Report form:</label>
                                                        <input type="file" id="transcript_report_form"
                                                            class="form-control @error('transcript_report_form') is-invalid @enderror"
                                                            name="transcript_report_form" aria-required="true" required>
                                                        @error('transcript_report_form')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group parents_or_guardian_id required">
                                                        <label class="control-label"
                                                            for="parents_or_guardian_id">Parents/Guardian
                                                            ID Photocopy:</label>
                                                        <input type="file" id="parents_or_guardian_id"
                                                            class="form-control @error('parents_or_guardian_id') is-invalid @enderror"
                                                            name="parents_or_guardian_id" aria-required="true" required>
                                                        @error('parents_or_guardian_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group personal_id required">
                                                        <label class="control-label" for="personal_id">Personal
                                                            ID/Passport
                                                            Photocopy:</label>
                                                        <input type="file" id="personal_id"
                                                            class="form-control @error('personal_id') is-invalid @enderror"
                                                            name="personal_id" aria-required="true">
                                                        @error('personal_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group birth_certificate required">
                                                        <label class="control-label" for="birth_certificate">Birth
                                                            Certificate
                                                            Photocopy:</label>
                                                        <input type="file" id="birth_certificate"
                                                            class="form-control @error('birth_certificate') is-invalid @enderror"
                                                            name="birth_certificate" aria-required="true" required>
                                                        @error('birth_certificate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group school_id required">
                                                        <label class="control-label" for="school_id">School ID
                                                            Photocopy:</label>
                                                        <input type="file" id="school_id"
                                                            class="form-control @error('school_id') is-invalid @enderror"
                                                            name="school_id" aria-required="true">
                                                        @error('school_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group fathers_death_certificate required">
                                                        <label class="control-label"
                                                            for="fathers_death_certificate">Father's
                                                            Death Certificate Photocopy:</label>
                                                        <input type="file" id="fathers_death_certificate"
                                                            class="form-control @error('fathers_death_certificate') is-invalid @enderror"
                                                            name="fathers_death_certificate" aria-required="true">
                                                        @error('fathers_death_certificate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mothers_death_certificate required">
                                                        <label class="control-label"
                                                            for="mothers_death_certificate">Mother's
                                                            Death Certificate Photocopy:</label>
                                                        <input type="file" id="mothers_death_certificate"
                                                            class="form-control @error('mothers_death_certificate') is-invalid @enderror"
                                                            name="mothers_death_certificate" aria-required="true">
                                                        @error('mothers_death_certificate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group current_fee_structure required">
                                                        <label class="control-label" for="current_fee_structure">Current
                                                            Fee
                                                            Structure:</label>
                                                        <input type="file" id="current_fee_structure"
                                                            class="form-control @error('current_fee_structure') is-invalid @enderror"
                                                            name="current_fee_structure" aria-required="true" required>
                                                        @error('current_fee_structure')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group admission_letter required">
                                                        <label class="control-label" for="admission_letter">Admission
                                                            Letter:</label>
                                                        <input type="file" id="admission_letter"
                                                            class="form-control @error('admission_letter') is-invalid @enderror"
                                                            name="admission_letter" aria-required="true" required>
                                                        @error('admission_letter')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- /Key Attachments --}}

                                        {{-- previous, next and submit buttons --}}

                                        <div class="form-navigation">
                                            <button type="button"
                                                class="btn-sm previous btn btn-info float-left">Previous</button>
                                            <button type="button"
                                                class="btn-sm next btn btn-info float-right">Next</button>
                                            <button type="submit" id="submitButton"
                                                class="btn-sm btn btn-success float-right">Submit</button>
                                        </div>

                                        {{-- <div class="col-md-12 mt-4 form-navigation">
                                        <div class="form-group">
                                            <a href="#" id="form_preview_details" type="submit"
                                                class="btn-sm btn btn-primary"><i class="fas fa-save"></i> Preview Before
                                                Submission</a>
                                            <button type="submit" class="btn-sm btn btn-success"><i
                                                    class="fas fa-save"></i> Save Details</button>

                                        </div>
                                    </div> --}}
                                        {{-- /previous, next and submit buttons --}}

                                    </form>
                                </div>
                            @else
                                <h3 class="text-center text-danger fas fa-folder-open p-4"> No active application</h3>
                            @endif

                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- jQuery -->
    <script src="{{ url('Admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script>


    {{-- select 2 --}}

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Custom js -->
    <script src="{{ url('Admin/js/bursary/select2.js') }}"></script>

    {{-- /select 2 --}}

    {{-- parsley js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- /parsley js --}}

    {{-- sections of previous, next, etc --}}
    <!-- Custom js -->
    <script src="{{ url('Admin/js/bursary/create.js') }}"></script>
    {{-- sections of previous, next, etc --}}


@endsection
