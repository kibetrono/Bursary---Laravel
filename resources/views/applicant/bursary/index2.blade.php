@extends('layouts.app')

@section('title')
    Bursary Application List
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('Admin/css/bursary/show.css') }}">
@endsection
@php
$startIndex = ($bursaries->currentPage() - 1) * $bursaries->perPage();
$user = Auth::user();
@endphp
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bursary Application List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Bursary Application List</li>
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

                    <!-- /.col -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Application List </h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-1">
                                <table id="users-table" class="table table-bordered table-hover">
                                    
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Applicant info.</th>
                                            <th>Institution info.</th>
                                            <th>Total Fees</th>
                                            <th>Balance</th>
                                            <th>Date Applied</th>
                                            @if ($user->hasRole('super-admin'))
                                            <th>Status</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bursaries as $index =>$bursary)
                                            @php
                                                $trimmed_adm = strlen($bursary->adm_or_reg_no) > 10 ? substr($bursary->adm_or_reg_no, 0, 10) . '...' : $bursary->adm_or_reg_no;
                                                $trimmed_institution = strlen($bursary->institution_name) > 20 ? substr($bursary->institution_name, 0, 15) . '...' : $bursary->institution_name;
                                                
                                            @endphp
                                            <tr>
                                                <td>{{  $startIndex + $index +1}}</td>
                                                <td>{{ $bursary->first_name }}
                                                    {{ $bursary->last_name }}
                                                    ({{ ucfirst($bursary->gender) }})
                                                </td>
                                                <td>{{ $trimmed_institution }} - {{ $trimmed_adm }}</td>
                                                <td>{{ $bursary->total_fees_payable }}</td>
                                                <td>{{ $bursary->fee_balance }}</td>
                                                <td>{{ $bursary->created_at->format('Y-m-d') }}</td>

                                                @if ($user->hasRole('super-admin'))
                                                <td>
                                                
                                                    @if ($bursary->status == '0')
                                                        <span class="btn-sm btn btn-warning ">Pending</span>
                                                    @elseif($bursary->status == '1')
                                                        <span class="btn-sm btn btn-success py-0">Approved</span>
                                                    @else
                                                        <span class="btn-sm btn btn-danger py-0">Rejected</span>
                                                    @endif
                                                    
                                                </td>
                                                @endif

                                                <td class="d-flex">
                                                    @can('approve bursary')
                                                        <a href="#" class="btn-sm btn btn-info mx-1" title="View"
                                                            data-toggle="modal"
                                                            data-target="#view_bursary{{ $bursary->id }}"><i
                                                                class="fas fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit bursary')
                                                        <a href="{{ route('admin.edit.bursary', encrypt($bursary->id)) }}"
                                                            class="btn-sm btn btn-warning" title="Update"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete bursary')
                                                        <form class="mx-1"
                                                            onclick="return confirm('Are you sure you want to delete?')"
                                                            action="{{ route('admin.destroy.bursary', encrypt($bursary->id)) }}"
                                                            method="POST" title="Delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn-sm btn btn-danger" type="submit"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>

                                                        {{-- <a href="#" class="btn-sm btn btn-danger mx-1" title="Update"><i
                                                            class="fas fa-trash"></i></a> --}}
                                                    @endcan

                                                </td>

                                            </tr>

                                            <!--view bursary-->
                                            <div class="modal fade" id="view_bursary{{ $bursary->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-3">
                                                            <h5 class="modal-title" id="myModalLabel">Name:
                                                                {{ $bursary->first_name }} {{ $bursary->last_name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close" title="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body p-3">

                                                            <ul class="nav nav-tabs">
                                                                <li class="nav-item p-0">
                                                                    <a class="nav-link active"
                                                                        href="#personal_data{{ $bursary->id }}"
                                                                        data-toggle="tab">Personal Details</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="#family_data{{ $bursary->id }}"
                                                                        data-toggle="tab">Family Information</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="#address_data{{ $bursary->id }}"
                                                                        data-toggle="tab">Address Information</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="#school_data{{ $bursary->id }}"
                                                                        data-toggle="tab">School Details</a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="#attachments_data{{ $bursary->id }}"
                                                                        data-toggle="tab">Key Attachments</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content">
                                                                {{-- personal details --}}
                                                                <div class="tab-pane active"
                                                                    id="personal_data{{ $bursary->id }}">
                                                                    <h5 style="font-weight: 500" class="text-center mt-2">
                                                                        Personal Details:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">First Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->first_name }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Last Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->last_name }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Gender:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->gender }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">ID/Passport no.:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->id_or_passport_no }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">D.O.B:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ \Carbon\Carbon::parse($bursary->date_of_birth)->format('Y-m-d') }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Telephone Number:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->telephone_number }}"
                                                                                readonly>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                {{-- /personal details --}}

                                                                {{-- family background information --}}
                                                                <div class="tab-pane"
                                                                    id="family_data{{ $bursary->id }}">
                                                                    <h5 style="font-weight: 500" class="text-center mt-2">
                                                                        Family Background Information:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">Parental Status:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->parental_status }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Number of
                                                                                Siblings:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->number_of_siblings }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Estimated Family
                                                                                Income:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->estimated_family_income }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <h5 style="font-size: 16px" class="text-bold mt-2">
                                                                        Father's Information:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">First Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->fathers_firstname }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Last Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->fathers_lastname }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Telephone Number:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->fathers_telephone_number }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Occupation:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->fathers_occupation }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Employment Type:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ ucfirst($bursary->fathers_employment_type) }}"
                                                                                readonly>
                                                                        </div>

                                                                    </div>
                                                                    <h5 style="font-size: 16px" class="text-bold mt-2">
                                                                        Mother's Information:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">First Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->mothers_firstname }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Last Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->mothers_lastname }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Telephone Number:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->mothers_telephone_number }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Occupation:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->mothers_occupation }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Employment Type:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ ucfirst($bursary->mothers_employment_type) }}"
                                                                                readonly>
                                                                        </div>

                                                                    </div>

                                                                    <h5 style="font-size: 16px" class="text-bold mt-2">
                                                                        Guardian's Information:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">First Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->guardians_firstname }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Last Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->guardians_lastname }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Telephone Number:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->guardians_telephone_number }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Occupation:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->guardians_occupation }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Employment Type:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ ucfirst($bursary->guardians_employment_type) }}"
                                                                                readonly>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                {{-- /family background information --}}

                                                                {{-- address information --}}
                                                                <div class="tab-pane"
                                                                    id="address_data{{ $bursary->id }}">
                                                                    <h5 style="font-weight: 500" class="text-center mt-2">
                                                                        Address Information:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">Location:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->location }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Sub location:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->sub_location }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Ward:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->ward }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Polling Station:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->polling_station }}"
                                                                                readonly>
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                {{-- /address information --}}

                                                                {{-- school details --}}
                                                                <div class="tab-pane"
                                                                    id="school_data{{ $bursary->id }}">
                                                                    <h5 style="font-weight: 500" class="text-center mt-2">
                                                                        School Details:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">School Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->institution_name }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Admission/Registration
                                                                                no.:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->adm_or_reg_no }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Study Mode:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->mode_of_study }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Class/Year of
                                                                                Study:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->year_of_study }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Course:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->course_name }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Postal Address:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->instititution_postal_address }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Telephone Number:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->instititution_telephone_number }}"
                                                                                readonly>
                                                                        </div>

                                                                    </div>
                                                                    <h5 style="font-size: 16px" class="text-bold mt-2">
                                                                        Fees Payable:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">Total Fees
                                                                                Payable:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->total_fees_payable }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Fees Paid:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->total_fees_paid }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Fee Balance:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->fee_balance }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>

                                                                    <h5 style="font-size: 16px" class="text-bold mt-2">
                                                                        Account Details:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label for="">Name of Bank:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->bank_name }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Branch:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->branch }}" readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="">Account Number:</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $bursary->account_number }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                {{-- /school details --}}

                                                                {{-- key attachments --}}
                                                                <div class="tab-pane"
                                                                    id="attachments_data{{ $bursary->id }}">
                                                                    <h5 style="font-weight: 500" class="text-center mt-2">
                                                                        Key Attachments:</h5>
                                                                    <div class="row">
                                                                        <div class="col-md-4 p-2">
                                                                            <div class="attachment">
                                                                                <span
                                                                                    class="attachment-name">Transcipt/Report
                                                                                    form:</span>

                                                                                <a href="{{ route('download.attachment', ['filename' => $bursary->transcript_report_form]) }}"
                                                                                    class="download-link"
                                                                                    title="Download transcipt/report form">
                                                                                    <i class="fas fa-download"></i>
                                                                                    <!-- Download icon from Font Awesome -->
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 p-2">
                                                                            <div class="attachment">
                                                                                <span
                                                                                    class="attachment-name">Parents/Guardian
                                                                                    ID:</span>
                                                                                <a href="{{ route('download.attachment', ['filename' => $bursary->parents_or_guardian_id]) }}"
                                                                                    class="download-link"
                                                                                    title="Download parents/guardian ID">
                                                                                    <i class="fas fa-download"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        @if ($bursary->personal_id)
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">Personal
                                                                                        ID/Passport:</span>
                                                                                    <a href="{{ route('download.attachment', ['filename' => $bursary->personal_id]) }}"
                                                                                        class="download-link"
                                                                                        title="Download personal ID/passport">
                                                                                        <i class="fas fa-download"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">Personal
                                                                                        ID/Passport: ---</span>

                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <div class="col-md-4 p-2">
                                                                            <div class="attachment">
                                                                                <span class="attachment-name">Birth
                                                                                    Certificate:</span>
                                                                                <a href="{{ route('download.attachment', ['filename' => $bursary->birth_certificate]) }}"
                                                                                    class="download-link"
                                                                                    title="Download birth certificate">
                                                                                    <i class="fas fa-download"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        @if ($bursary->school_id)
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">School
                                                                                        ID:</span>
                                                                                    <a href="{{ route('download.attachment', ['filename' => $bursary->school_id]) }}"
                                                                                        class="download-link"
                                                                                        title="Download school ID">
                                                                                        <i class="fas fa-download"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">School
                                                                                        ID: ---</span>

                                                                                </div>
                                                                            </div>
                                                                        @endif

                                                                        @if ($bursary->fathers_death_certificate)
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">Father's
                                                                                        Death Certificate:</span>
                                                                                    <a href="{{ route('download.attachment', ['filename' => $bursary->fathers_death_certificate]) }}"
                                                                                        class="download-link"
                                                                                        title="Download father's death certificate">
                                                                                        <i class="fas fa-download"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">Father's
                                                                                        Death Certificate: ---</span>

                                                                                </div>
                                                                            </div>
                                                                        @endif


                                                                        @if ($bursary->mothers_death_certificate)
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">Mother's
                                                                                        Death Certificate:</span>
                                                                                    <a href="{{ route('download.attachment', ['filename' => $bursary->mothers_death_certificate]) }}"
                                                                                        class="download-link"
                                                                                        title="Download mother's death certificate">
                                                                                        <i class="fas fa-download"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-4 p-2">
                                                                                <div class="attachment">
                                                                                    <span class="attachment-name">Mother's
                                                                                        Death Certificate: --- </span>
                                                                                </div>
                                                                            </div>
                                                                        @endif

                                                                        <div class="col-md-4 p-2">
                                                                            <div class="attachment">
                                                                                <span class="attachment-name">Current Fee
                                                                                    Structure:</span>
                                                                                <a href="{{ route('download.attachment', ['filename' => $bursary->current_fee_structure]) }}"
                                                                                    class="download-link"
                                                                                    title="Download current fee structure">
                                                                                    <i class="fas fa-download"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4 p-2">
                                                                            <div class="attachment">
                                                                                <span class="attachment-name">Admission
                                                                                    Letter:</span>
                                                                                <a href="{{ route('download.attachment', ['filename' => $bursary->admission_letter]) }}"
                                                                                    class="download-link"
                                                                                    title="Download admission letter">
                                                                                    <i class="fas fa-download"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                {{-- /key attachments --}}

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer mb-2">
                                                            @can('approve bursary')
                                                                <button type="button" class="btn-sm btn btn-success"
                                                                    onclick="approveApplication({{ $bursary->id }})">Approve</button>
                                                            @endcan
                                                            @can('reject bursary')
                                                                <button type="button" class="btn-sm btn btn-danger"
                                                                    onclick="rejectApplication({{ $bursary->id }})">Reject</button>
                                                            @endcan

                                                            <button type="button"
                                                                class="btn-sm btn btn-default bg-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/view bursary-->

                                        @empty
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="fas fa-folder-open"> No Applications Found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Applicant info.</th>
                                            <th>Institution info.</th>
                                            <th>Total Fees</th>
                                            <th>Balance</th>
                                            <th>Date Applied</th>
                                            @if ($user->hasRole('super-admin'))
                                            <th>Status</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($bursaries->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $bursaries->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $bursaries->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($bursaries->getUrlRange(1, $bursaries->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $bursaries->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$bursaries->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $bursaries->nextPageUrl() }}"
                                                                aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
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

    <!-- Custom js -->
    <script src="{{ url('Admin/js/bursary/index.js') }}"></script>

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        function approveApplication(bursaryId) {
            if (confirm("Are you sure you want to approve this application?")) {
                $.ajax({
                    url: '{{ route('bursary.updateApprovedStatus') }}',
                    type: 'POST',
                    data: {
                        bursaryId: bursaryId
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = response.url;
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }

        function rejectApplication(bursaryId) {
            if (confirm("Are you sure you want to reject this application?")) {
                $.ajax({
                    url: '{{ route('bursary.updateRejectedStatus') }}',
                    type: 'POST',
                    data: {
                        bursaryId: bursaryId
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = response.url;
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });

            }
        }
    </script>
@endsection
