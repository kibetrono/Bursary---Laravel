@extends('layouts.app')

@section('title')
    Update Finacial Year: {{ $applicationPeriod->financial_year }}
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    {{-- /select 2 --}}
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Update Finacial Year: {{ $applicationPeriod->financial_year }}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('application-period.index') }}">Application Period</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $applicationPeriod->financial_year }}</li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @php
            $startYear = 2000; // Start year
            $endYear = date('Y'); // Current year
            $isSelected = !empty($financialYear); // Check if a financial year is selected
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
                                <h3 class="card-title">Update Bursary Financial Year</h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.index') }}" class="btn-md btn btn-danger"><i class="fas fa-users"></i> All Users</a> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="p-3" action="{{ route('application-period.update', $applicationPeriod->id) }}"
                                method="POST" class="my-4">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12 m-1">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group financial_year required">
                                            <label class="control-label" for="financial_year">Academic Finacial
                                                Year:</label>
                                            <select id="financial_year" name="financial_year"
                                                class="form-control @error('financial_year') is-invalid @enderror" required>
                                                <option disabled {{ !$isSelected ? 'selected' : '' }}>Select Financial Year
                                                </option>
                                                @for ($year = $startYear; $year <= $endYear; $year++)
                                                    @php
                                                        $nextYear = $year + 1;
                                                        $yearRange = $year . ' - ' . $nextYear;
                                                    @endphp
                                                    <option value="{{ $yearRange }}"
                                                        {{ $yearRange == $financialYear ? 'selected' : '' }}>
                                                        {{ $yearRange }}</option>
                                                @endfor
                                            </select>

                                            @error('financial_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group period_from required">
                                            <label class="control-label" for="period_from">Application Period From:</label>
                                            <input type="date" id="period_from"
                                                value="{{ \Carbon\Carbon::parse($applicationPeriod->period_from)->format('Y-m-d') }}"
                                                class="form-control @error('period_from') is-invalid @enderror"
                                                name="period_from" aria-required="true" required>
                                            @error('period_from')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group period_to required">
                                            <label class="control-label" for="period_to">Application Period To:</label>
                                            <input type="date" id="period_to"
                                                value="{{ \Carbon\Carbon::parse($applicationPeriod->period_to)->format('Y-m-d') }}"
                                                class="form-control @error('period_to') is-invalid @enderror"
                                                name="period_to" aria-required="true" required>
                                            @error('period_to')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group status required">
                                            <label class="control-label" for="status">Status:</label>
                                            <select id="status" name="status"
                                                class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="Inactive"
                                                    {{ $applicationPeriod->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                <option value="Active"
                                                    {{ $applicationPeriod->status === 1 ? 'selected' : '' }}>Active</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-md-4"></div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1">
                                        <button class="btn-md btn btn-success">Update</button>
                                    </div>

                                </div> {{-- end of row --}}

                            </form>
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

    <!-- Custom js -->
    <script src="{{ url('Admin/js/application-period/select2.js') }}"></script>
    {{-- /select 2 --}}
@endsection
