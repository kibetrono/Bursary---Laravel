@extends('layouts.app')

@section('title')
    Update Applicant: {{ $bursaryapplied->first_name }} {{ $bursaryapplied->last_name }}
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
    <link rel="stylesheet" href="{{ url('Admin/css/bursary/edit.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Application for: {{ $bursaryapplied->first_name }} {{ $bursaryapplied->last_name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('bursary.index') }}">Bursary Applications</a>
                            </li>
                            <li class="breadcrumb-item active">Update</li>
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

        @php
            $startYear = 2000; // Start year
            $endYear = date('Y'); // Current year
        @endphp

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
                            <!-- form start -->
                            <div class="card-body">
                                <form id="application_form" method="POST"
                                    action="{{ route('admin.update.bursary', $bursaryapplied->id) }}" class="bursary-form">
                                    @csrf
                                    @method('PUT')

                                    {{-- Personal Information --}}
                                    <div class="form-section">
                                        <div class="row">
                                            <div class="col-md-12 m-1">
                                                <h5 class="text-center text-bold">Personal Details</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group first_name required">
                                                    <label class="control-label" for="first_name">First Name:</label>
                                                    <input type="text" id="first_name"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        name="first_name" aria-required="true" placeholder="First name"
                                                        value="{{ $bursaryapplied->first_name }}" required>
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
                                                        value="{{ $bursaryapplied->last_name }}" required>
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
                                                        class="form-control @error('gender') is-invalid @enderror" required>
                                                        <option value="male"
                                                            {{ $bursaryapplied->gender === 'male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="female"
                                                            {{ $bursaryapplied->gender === 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                        <option value="others"
                                                            {{ $bursaryapplied->gender === 'others' ? 'selected' : '' }}>
                                                            Others</option>
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
                                                        placeholder="ID or passport number"
                                                        value="{{ $bursaryapplied->id_or_passport_no }}">
                                                    @error('id_or_passport_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group date_of_birth required">
                                                    <label class="control-label" for="date_of_birth">Date of Birth:</label>
                                                    <input type="date" id="date_of_birth"
                                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                                        name="date_of_birth" aria-required="true"
                                                        value="{{ \Carbon\Carbon::parse($bursaryapplied->date_of_birth)->format('Y-m-d') }}"
                                                        required>
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
                                                        placeholder="Telephone number"
                                                        value="{{ $bursaryapplied->telephone_number }}">
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
                                            <div class="col-md-12 m-1">
                                                <h5 class="text-center text-bold">Family Background Information</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group parental_status required">
                                                    <label class="control-label" for="parental_status">Parental
                                                        Status:</label>
                                                    <select id="parental_status" name="parental_status"
                                                        class="form-control @error('parental_status') is-invalid @enderror"
                                                        required>
                                                        <option value="Single Parent"
                                                            {{ $bursaryapplied->parental_status === 'Single Parent' ? 'selected' : '' }}>
                                                            Single Parent</option>
                                                        <option value="One Parent Dead"
                                                            {{ $bursaryapplied->parental_status === 'One Parent Dead' ? 'selected' : '' }}>
                                                            One Parent Dead</option>
                                                        <option value="Both Parents Dead"
                                                            {{ $bursaryapplied->parental_status === 'Both Parents Dead' ? 'selected' : '' }}>
                                                            Both Parents Dead</option>
                                                        <option value="Both Parents Alive"
                                                            {{ $bursaryapplied->parental_status === 'Both Parents Alive' ? 'selected' : '' }}>
                                                            Both Parents Alive</option>
                                                        <option value="Others"
                                                            {{ $bursaryapplied->parental_status === 'Others' ? 'selected' : '' }}>
                                                            Others</option>
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
                                                        placeholder="Number of siblings"
                                                        value="{{ $bursaryapplied->number_of_siblings }}" required>
                                                    @error('number_of_siblings')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group estimated_family_income required">
                                                    <label class="control-label" for="estimated_family_income">Estimated
                                                        Family Income:</label>
                                                    <input type="number" id="estimated_family_income"
                                                        class="form-control @error('estimated_family_income') is-invalid @enderror"
                                                        name="estimated_family_income" aria-required="true"
                                                        placeholder="Family income(yearly)"
                                                        value="{{ $bursaryapplied->estimated_family_income }}" required>
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
                                                        placeholder="Father's firstname"
                                                        value="{{ $bursaryapplied->fathers_firstname }}">
                                                    @error('fathers_firstname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group fathers_lastname required">
                                                    <label class="control-label" for="fathers_lastname">Last Name:</label>
                                                    <input type="text" id="fathers_lastname"
                                                        class="form-control @error('fathers_lastname') is-invalid @enderror"
                                                        name="fathers_lastname" aria-required="true"
                                                        placeholder="Father's lastname"
                                                        value="{{ $bursaryapplied->fathers_lastname }}">
                                                    @error('fathers_lastname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group fathers_telephone_number required">
                                                    <label class="control-label" for="fathers_telephone_number">Telephone
                                                        Number:</label>
                                                    <input type="number" id="fathers_telephone_number"
                                                        class="form-control @error('fathers_telephone_number') is-invalid @enderror"
                                                        name="fathers_telephone_number" aria-required="true"
                                                        placeholder="Father's phone number"
                                                        value="{{ $bursaryapplied->fathers_telephone_number }}">
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
                                                        placeholder="Father's occupation"
                                                        value="{{ $bursaryapplied->fathers_occupation }}">
                                                    @error('fathers_occupation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group fathers_employment_type required">
                                                    <label class="control-label" for="fathers_employment_type">Employment
                                                        Type:</label>
                                                    <select id="fathers_employment_type" name="fathers_employment_type"
                                                        class="form-control @error('fathers_employment_type') is-invalid @enderror">
                                                        <option value="" selected disabled>Select father's employment
                                                            type</option>
                                                        <option value="permanent"
                                                            {{ $bursaryapplied->fathers_employment_type === 'permanent' ? 'selected' : '' }}>
                                                            Permanent</option>
                                                        <option value="contractual"
                                                            {{ $bursaryapplied->fathers_employment_type === 'contractual' ? 'selected' : '' }}>
                                                            Contractual</option>
                                                        <option value="casual"
                                                            {{ $bursaryapplied->fathers_employment_type === 'casual' ? 'selected' : '' }}>
                                                            Casual</option>
                                                        <option value="retired"
                                                            {{ $bursaryapplied->fathers_employment_type === 'retired' ? 'selected' : '' }}>
                                                            Retired</option>
                                                        <option value="self_employed"
                                                            {{ $bursaryapplied->fathers_employment_type === 'self_employed' ? 'selected' : '' }}>
                                                            Self Employed</option>
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
                                                        placeholder="Mother's firstname"
                                                        value={{ $bursaryapplied->mothers_firstname }}>
                                                    @error('mothers_firstname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mothers_lastname required">
                                                    <label class="control-label" for="mothers_lastname">Last Name:</label>
                                                    <input type="text" id="mothers_lastname"
                                                        class="form-control @error('mothers_lastname') is-invalid @enderror"
                                                        name="mothers_lastname" aria-required="true"
                                                        placeholder="Mother's lastname"
                                                        value={{ $bursaryapplied->mothers_lastname }}>
                                                    @error('mothers_lastname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mothers_telephone_number required">
                                                    <label class="control-label" for="mothers_telephone_number">Telephone
                                                        Number:</label>
                                                    <input type="number" id="mothers_telephone_number"
                                                        class="form-control @error('mothers_telephone_number') is-invalid @enderror"
                                                        name="mothers_telephone_number" aria-required="true"
                                                        placeholder="Mother's phone number"
                                                        value={{ $bursaryapplied->mothers_telephone_number }}>
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
                                                        placeholder="Mother's occupation"
                                                        value={{ $bursaryapplied->mothers_occupation }}>
                                                    @error('mothers_occupation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group mothers_employment_type required">
                                                    <label class="control-label" for="mothers_employment_type">Employment
                                                        Type:</label>
                                                    <select id="mothers_employment_type" name="mothers_employment_type"
                                                        class="form-control @error('mothers_employment_type') is-invalid @enderror">
                                                        <option value="" selected disabled>Select Mother's employment
                                                            type</option>
                                                        <option value="permanent"
                                                            {{ $bursaryapplied->mothers_employment_type === 'permanent' ? 'selected' : '' }}>
                                                            Permanent</option>
                                                        <option value="contractual"
                                                            {{ $bursaryapplied->mothers_employment_type === 'contractual' ? 'selected' : '' }}>
                                                            Contractual</option>
                                                        <option value="casual"
                                                            {{ $bursaryapplied->mothers_employment_type === 'casual' ? 'selected' : '' }}>
                                                            Casual</option>
                                                        <option value="retired"
                                                            {{ $bursaryapplied->mothers_employment_type === 'retired' ? 'selected' : '' }}>
                                                            Retired</option>
                                                        <option value="self_employed"
                                                            {{ $bursaryapplied->mothers_employment_type === 'self_employed' ? 'selected' : '' }}>
                                                            Self Employed</option>
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
                                                        placeholder="Guardian's firstname"
                                                        value={{ $bursaryapplied->guardians_firstname }}>
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
                                                        placeholder="Guardian's lastname"
                                                        value={{ $bursaryapplied->guardians_lastname }}>
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
                                                        placeholder="Guardian's phone number"
                                                        value={{ $bursaryapplied->guardians_telephone_number }}>
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
                                                        placeholder="Guardian's occupation"
                                                        value={{ $bursaryapplied->guardians_occupation }}>
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
                                                        <option value="permanent"
                                                            {{ $bursaryapplied->guardians_employment_type === 'permanent' ? 'selected' : '' }}>
                                                            Permanent</option>
                                                        <option value="contractual"
                                                            {{ $bursaryapplied->guardians_employment_type === 'contractual' ? 'selected' : '' }}>
                                                            Contractual</option>
                                                        <option value="casual"
                                                            {{ $bursaryapplied->guardians_employment_type === 'casual' ? 'selected' : '' }}>
                                                            Casual</option>
                                                        <option value="retired"
                                                            {{ $bursaryapplied->guardians_employment_type === 'retired' ? 'selected' : '' }}>
                                                            Retired</option>
                                                        <option value="self_employed"
                                                            {{ $bursaryapplied->guardians_employment_type === 'self_employed' ? 'selected' : '' }}>
                                                            Self Employed</option>
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
                                            <div class="col-md-12 m-1">
                                                <h5 class="text-center text-bold">Address Information</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group location required">
                                                    <label class="control-label" for="location">Location:</label>
                                                    <input type="text" id="location"
                                                        class="form-control @error('location') is-invalid @enderror"
                                                        name="location" aria-required="true" placeholder="Location name"
                                                        value={{ $bursaryapplied->location }} required>
                                                    @error('location')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group sub_location required">
                                                    <label class="control-label" for="sub_location">Sub Location:</label>
                                                    <input type="text" id="sub_location"
                                                        class="form-control @error('sub_location') is-invalid @enderror"
                                                        name="sub_location" aria-required="true"
                                                        placeholder="sub location"
                                                        value={{ $bursaryapplied->sub_location }} required>
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
                                                        value={{ $bursaryapplied->ward }} required>
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
                                                        placeholder="Polling station"
                                                        value={{ $bursaryapplied->polling_station }} required>
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
                                            <div class="col-md-12 m-1">
                                                <h5 class="text-center text-bold">School Details</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group institution_name required">
                                                    <label class="control-label" for="date_of_birth">Name of
                                                        school/college/university:</label>
                                                    <input type="text" id="institution_name"
                                                        class="form-control @error('institution_name') is-invalid @enderror"
                                                        name="institution_name" aria-required="true"
                                                        placeholder="School name"
                                                        value="{{ $bursaryapplied->institution_name }}" required>
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
                                                        placeholder="Admission or registration number"
                                                        value="{{ $bursaryapplied->adm_or_reg_no }}" required>
                                                    @error('adm_or_reg_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group mode_of_study required">
                                                    <label class="control-label" for="mode_of_study">Study Mode:</label>
                                                    <select id="mode_of_study" name="mode_of_study"
                                                        class="form-control @error('mode_of_study') is-invalid @enderror"
                                                        required>
                                                        <option value="" selected disabled>Select study mode</option>
                                                        <option value="day"
                                                            {{ $bursaryapplied->mode_of_study === 'day' ? 'selected' : '' }}>
                                                            Day</option>
                                                        <option value="boarding"
                                                            {{ $bursaryapplied->mode_of_study === 'boarding' ? 'selected' : '' }}>
                                                            Boarding</option>
                                                        <option value="regular"
                                                            {{ $bursaryapplied->mode_of_study === 'regular' ? 'selected' : '' }}>
                                                            Regular</option>
                                                        <option value="parallel"
                                                            {{ $bursaryapplied->mode_of_study === 'parallel' ? 'selected' : '' }}>
                                                            Parallel</option>
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
                                                    <label class="control-label" for="year_of_study">Grade/Class/Year of
                                                        Study:</label>
                                                    <input type="number" id="year_of_study"
                                                        class="form-control @error('year_of_study') is-invalid @enderror"
                                                        name="year_of_study" aria-required="true"
                                                        placeholder="Grade/class/year of study"
                                                        value="{{ $bursaryapplied->year_of_study }}" required>
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
                                                        name="course_name" aria-required="true" placeholder="Course name"
                                                        value="{{ $bursaryapplied->course_name }}">
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
                                                        placeholder="Institution's postal address"
                                                        value="{{ $bursaryapplied->instititution_postal_address }}"
                                                        required>
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
                                                        placeholder="Institution's telephone number"
                                                        value="{{ $bursaryapplied->instititution_telephone_number }}"
                                                        required>
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
                                                        placeholder="Total fees payable"
                                                        value="{{ $bursaryapplied->total_fees_payable }}" required>
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
                                                        placeholder="Total amount paid"
                                                        value="{{ $bursaryapplied->total_fees_paid }}" required>
                                                    @error('total_fees_paid')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group fee_balance required">
                                                    <label class="control-label" for="fee_balance">Fee Balance:</label>
                                                    <input type="number" id="fee_balance"
                                                        class="form-control @error('fee_balance') is-invalid @enderror"
                                                        name="fee_balance" aria-required="true"
                                                        placeholder="Balance amount"
                                                        value="{{ $bursaryapplied->fee_balance }}" required>
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
                                                        <option value="" selected disabled>Select bank name</option>
                                                        <option value="Equity Bank"
                                                            {{ $bursaryapplied->bank_name === 'Equity Bank' ? 'selected' : '' }}>
                                                            Equity Bank</option>
                                                        <option value="KCB Bank (Kenya Commercial Bank)"
                                                            {{ $bursaryapplied->bank_name === 'KCB Bank (Kenya Commercial Bank)' ? 'selected' : '' }}>
                                                            KCB Bank (Kenya Commercial Bank)</option>
                                                        <option value="Cooperative Bank of Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Cooperative Bank of Kenya' ? 'selected' : '' }}>
                                                            Cooperative Bank of Kenya</option>
                                                        <option value="Barclays Bank of Kenya (Absa Bank Kenya PLC)"
                                                            {{ $bursaryapplied->bank_name === 'Barclays Bank of Kenya (Absa Bank Kenya PLC)' ? 'selected' : '' }}>
                                                            Barclays Bank of Kenya (Absa Bank Kenya PLC)</option>
                                                        <option value="Standard Chartered Bank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Standard Chartered Bank Kenya' ? 'selected' : '' }}>
                                                            Standard Chartered Bank Kenya</option>
                                                        <option value="CFC Stanbic Bank (Stanbic Bank Kenya)"
                                                            {{ $bursaryapplied->bank_name === 'CFC Stanbic Bank (Stanbic Bank Kenya)' ? 'selected' : '' }}>
                                                            CFC Stanbic Bank (Stanbic Bank Kenya)</option>
                                                        <option value="Diamond Trust Bank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Diamond Trust Bank Kenya' ? 'selected' : '' }}>
                                                            Diamond Trust Bank Kenya</option>
                                                        <option value="National Bank of Kenya"
                                                            {{ $bursaryapplied->bank_name === 'National Bank of Kenya' ? 'selected' : '' }}>
                                                            National Bank of Kenya</option>
                                                        <option value="NIC Bank (Now part of NCBA Bank)"
                                                            {{ $bursaryapplied->bank_name === 'NIC Bank (Now part of NCBA Bank)' ? 'selected' : '' }}>
                                                            NIC Bank (Now part of NCBA Bank)</option>
                                                        <option
                                                            value="Commercial Bank of Africa (CBA) - Merged with NIC Bank to form NCBA Bank"
                                                            {{ $bursaryapplied->bank_name === 'Commercial Bank of Africa (CBA) - Merged with NIC Bank to form NCBA Bank' ? 'selected' : '' }}>
                                                            Commercial Bank of Africa (CBA) - Merged with NIC Bank to form
                                                            NCBA Bank</option>
                                                        <option value="I&M Bank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'I&M Bank Kenya' ? 'selected' : '' }}>
                                                            I&M Bank Kenya</option>
                                                        <option value="Ecobank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Ecobank Kenya' ? 'selected' : '' }}>
                                                            Ecobank Kenya</option>
                                                        <option value="Bank of Africa Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Bank of Africa Kenya' ? 'selected' : '' }}>
                                                            Bank of Africa Kenya</option>
                                                        <option value="Family Bank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Family Bank Kenya' ? 'selected' : '' }}>
                                                            Family Bank Kenya</option>
                                                        <option value="Gulf African Bank"
                                                            {{ $bursaryapplied->bank_name === 'Gulf African Bank' ? 'selected' : '' }}>
                                                            Gulf African Bank</option>
                                                        <option value="Credit Bank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Credit Bank Kenya' ? 'selected' : '' }}>
                                                            Credit Bank Kenya</option>
                                                        <option value="Prime Bank Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Prime Bank Kenya' ? 'selected' : '' }}>
                                                            Prime Bank Kenya</option>
                                                        <option value="Sidian Bank (formerly K-Rep Bank)"
                                                            {{ $bursaryapplied->bank_name === 'Sidian Bank (formerly K-Rep Bank)' ? 'selected' : '' }}>
                                                            Sidian Bank (formerly K-Rep Bank)</option>
                                                        <option value="Victoria Commercial Bank"
                                                            {{ $bursaryapplied->bank_name === 'Victoria Commercial Bank' ? 'selected' : '' }}>
                                                            Victoria Commercial Bank</option>
                                                        <option value="Housing Finance Company of Kenya"
                                                            {{ $bursaryapplied->bank_name === 'Housing Finance Company of Kenya' ? 'selected' : '' }}>
                                                            Housing Finance Company of Kenya</option>
                                                        <option value="Chase Bank Kenya (Currently under receivership)"
                                                            {{ $bursaryapplied->bank_name === 'Chase Bank Kenya (Currently under receivership)' ? 'selected' : '' }}>
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
                                                        value="{{ $bursaryapplied->branch }}" required>
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
                                                        placeholder="Account number"
                                                        value="{{ $bursaryapplied->account_number }}" required>
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

                                    {{-- /Key Attachments --}}

                                    {{-- previous, next and submit buttons --}}

                                    <div class="form-navigation">
                                        <button type="button"
                                            class="btn-sm previous btn btn-info float-left">Previous</button>
                                        <button type="button" class="btn-sm next btn btn-info float-right">Next</button>
                                        <button type="submit" class="btn-sm btn btn-success float-right">Update
                                            Application</button>
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

    <script src="{{ url('Admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script>



    {{-- select 2 --}}

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            // Initialize Select2
            $('#bank_name').select2();

            // Set option selected onchange
            $('#user_selected').change(function() {
                var value = $(this).val();

                // Set selected 
                $('#bank_name').val(value);
                $('#bank_name').select2().trigger('change');

            });
        });
    </script>
    {{-- /select 2 --}}


    {{-- parsley js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- /parsley js --}}

    {{-- sections of previous, next, etc --}}
    <script>
        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {
                $sections.removeClass('current').eq(index).addClass('current');
                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [type=submit]').toggle(atTheEnd);
            }

            function currentIndex() {
                return $sections.index($sections.filter('.current'))
            }

            $('.form-navigation .previous').click(function() {
                navigateTo(currentIndex() - 1)
            });

            $('.form-navigation .next').click(function() {
                $('.bursary-form').parsley().whenValidate({
                    group: 'block-' + currentIndex()
                }).done(function() {
                    navigateTo(currentIndex() + 1)
                });
            });
            $sections.each(function(index, section) {
                $(section).find(':input').attr('data-parsley-group', 'block-' + index);

            });

            navigateTo(0);
        })
    </script>

    {{-- sections of previous, next, etc --}}
@endsection
