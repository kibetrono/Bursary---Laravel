@extends('layouts.app')

@section('title')
    Dashboard
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

@php
    $users = App\Models\User::all(); // Retrieve all users from the database
    
@endphp

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
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

                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    @if(Gate::check('manage user'))
                                        @if (count($users) > 0)
                                            {{ count($users) }}
                                        @else
                                            0
                                        @endif
                                    @else
                                        -
                                    @endif
                                </h3>

                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-secret"></i>
                            </div>
                            <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                @if(Gate::check('manage staff'))
                                <h3>{{ $staffCount }}</h3>
                                @else
                                <h3> - </h3>
                                @endif

                                <p>Total Staffs</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ route('staff_users.list') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    {{-- ./col --}}
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                @if(Gate::check('manage role'))
                                <h3>{{ $totalRolesCount }}</h3>
                                @else
                                <h3> - </h3>
                                @endif

                                <p>Total Roles</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <a href="{{ route('role.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $bursaryApplicationsCount }}</h3>

                                <p>Total Applications</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hand-holding"></i>
                            </div>
                            <a href="{{ route('bursary.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
                {{-- /.row2 --}}
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-9 connectedSortable bursary_graph_display">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Last Ten Finacial Years
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#approved_chart_area"
                                                data-toggle="tab">Approved</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#rejected_chart_area" data-toggle="tab">Rejected</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pending_chart_area" data-toggle="tab">Pending</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body bursary_graph_display_body">
                                <div class="tab-content p-0">


                                    <div class="chart tab-pane active" id="approved_chart_area"
                                        style="position: relative; height: auto;">
                                        {{-- Approved chart --}}
                                        <div style="width: 100%">
                                            <canvas id="approved_chart"></canvas>
                                        </div>

                                    </div>

                                    <div class="chart tab-pane" id="rejected_chart_area"
                                        style="position: relative; height: auto;">
                                        {{-- Rejected chart --}}
                                        <div style="width: 100%">
                                            <canvas id="rejected_chart"></canvas>
                                        </div>
                                    </div>

                                    <div class="chart tab-pane" id="pending_chart_area"
                                        style="position: relative; height: auto;">
                                        {{-- Rejected chart --}}
                                        <div style="width: 100%">
                                            <canvas id="pending_chart"></canvas>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-3 connectedSortable">

                        <div class="row">
                            <!-- ./col -->
                            <div class="col-lg-12 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner text-center">
                                        <h3>{{ $approvedbursaryApplicationsCount }}</h3>

                                        <p>Approved Applications</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-up"></i>
                                    </div>
                                    <a href="{{ route('approved.applications') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                            <!-- ./col -->
                            <div class="col-lg-12 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner text-center">
                                        <h3>{{ $pendingbursaryApplicationsCount }}</h3>

                                        <p>Pending Applications</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <a href="{{ route('bursary.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                            <!-- ./col -->
                            <div class="col-lg-12 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner text-center">
                                        <h3>{{ $rejectedbursaryApplicationsCount }}</h3>

                                        <p>Rejected Applications</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-thumbs-down"></i>
                                    </div>
                                    <a href="{{ route('rejected.applications') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                        </div>

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
        var totalApplications = @json($totalApplications);
        // approved
        var approvalPercentages = @json($approvalPercentages);
        // rejected
        var rejectralPercentages = @json($rejectralPercentages);
        // pending
        var pendralPercentages = @json($pendralPercentages);
    </script>
    <!-- Custom js -->
    <script src="{{ url('Admin/js/dashboard/admin/app.js') }}"></script>
@endsection
