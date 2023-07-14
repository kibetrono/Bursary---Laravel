@extends('layouts.app')

@section('title')
    User Dashboard
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/summernote/summernote-bs4.min.css') }}">


    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Applicant Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="row px-3">
            <div class="col-sm-12">
                @include('layouts.flash-messages')
            </div>

        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>-</h3>
                                <span class="info-box-text">Apply Bursary</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hand-holding"></i>
                            </div>
                            <a href="{{ route('user.bursary.create.form') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>-</h3>
                                <span class="info-box-text">Application History</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <a href="{{ route('user.bursary.history', encrypt(Auth::user()->id)) }}"
                                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalBursaryApplications }}</h3>
                                <span class="info-box-text">Total Applications</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hand-holding"></i>
                            </div>
                            <a href="{{ route('user.bursary.history', encrypt(Auth::user()->id)) }}"
                                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-olive">
                            <div class="inner">
                                <h3>{{ $approvedApplications }}</h3>
                                <span class="info-box-text">Approved Applications</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-up"></i>
                            </div>
                            <a href="{{ route('user.bursary.history', encrypt(Auth::user()->id)) }}"
                                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-9 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Application Status
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#application_status_donut"
                                                data-toggle="tab">Pie Chart</a>
                                        </li>

                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="application_status_donut"
                                        style="position: relative;height:300px">
                                        <canvas id="applicationStatusDonutChart" style="height: 300px;"></canvas>
                                    </div>

                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-3 connectedSortable">
                        <!-- ./col -->

                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $pendingApplications }}</h3>
                                <span class="info-box-text">Pending Applications</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-down"></i>
                            </div>
                            <a href="{{ route('user.bursary.history', encrypt(Auth::user()->id)) }}"
                                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $rejectedApplications }}</h3>
                                <span class="info-box-text">Rejected Applications</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-thumbs-down"></i>
                            </div>
                            <a href="{{ route('user.bursary.history', encrypt(Auth::user()->id)) }}"
                                class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner mb-3">
                                {{-- <span class="info-box-text">Consttuencies</span> --}}

                                <h5>
                                    @if ($applicationActive)
                                        {{ $periodFrom }} to {{ $periodTo }}
                                    @else
                                        Not set
                                    @endif
                                </h5>
                                <span class="info-box-text">Application Period</span>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <a href="{{ url('home') }}" class="small-box-footer"><i
                                    class="fas fa-calendar-alt"></i></a>
                        </div>

                        <!-- ./col -->
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- jQuery -->
    <script src="{{ url('Admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->

    <script src="{{ url('Admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ url('Admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    {{-- "{{url('adminLTE/dist/img/AdminLTELogo.png')}}" --}}
    <script src="{{ url('Admin/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ url('Admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ url('Admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ url('Admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ url('Admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('Admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url('Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ url('Admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.js') }}"></script>

    <script>
        var applicationStatuses = @json($applicationStatuses);
    </script>
    <!-- Custom js -->
    <script src="{{ url('Admin/js/dashboard/applicant/app.js') }}"></script>
@endsection
