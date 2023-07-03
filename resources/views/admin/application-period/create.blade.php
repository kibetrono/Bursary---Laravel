@extends('layouts.app')

@section('title')
    Add New Application Period
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
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Add New Application Period</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('application-period.index') }}">Application Periods</a>
                            </li>
                            <li class="breadcrumb-item active">Add New Application Period
                            </li>
                        </ol>
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
                                <h3 class="card-title">New Application Period</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- form start -->
                                <form  action="{{ route('application-period.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12 m-1">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group financial_year required">
                                                <label class="control-label" for="financial_year">Academic Finacial
                                                    Year:</label>
                                                <select id="financial_year" name="financial_year"
                                                    class="form-control @error('financial_year') is-invalid @enderror"
                                                    required>
                                                    <option selected disabled>Select Financial Year</option>
                                                    @for ($year = $startYear; $year <= $endYear; $year++)
                                                        @php
                                                            $nextYear = $year + 1;
                                                            $yearRange = $year . ' - ' . $nextYear;
                                                        @endphp
                                                        <option value="{{ $yearRange }}">{{ $yearRange }}</option>
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
                                                <label class="control-label" for="period_from">Application Period
                                                    From:</label>
                                                <input type="date" id="period_from"
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
                                                    <option value="Inactive" selected>Inactive</option>
                                                    <option value="Active">Active</option>
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
                                            <button class="btn-md btn btn-success">Save</button>
                                        </div>

                                    </div> {{-- end of row --}}

                                </form>
                                <!-- form end -->
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

    <!-- Custom js -->
    <script src="{{ url('Admin/js/application-period/select2.js') }}"></script>
@endsection
