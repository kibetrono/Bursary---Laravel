@extends('layouts.app')

@section('title')
    Bursary Application History
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>History</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">History</li>
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
                                <h3 class="card-title">History </h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-header mt-2">
                                <h3 class="card-title"><i class="fas fa-history"></i> Bursary Application History</h3>

                                <div class="card-tools mx-4 my-1">
                                    <form action="#" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="user_search_bursary_history" value=""
                                                class="form-control float-right" placeholder="Search by name or school">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">First Name</th>
                                            <th style="width:12%">Last Name</th>
                                            <th style="width:12%">School</th>
                                            <th style="width:12%">Fees Paid</th>
                                            <th style="width:15%">Balance</th>
                                            <th style="width:15%">Date applied</th>
                                            <th style="width:15%">Date updated</th>
                                            <th style="width:50%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bursaries as $bursary)
                                            <tr>
                                                <td>{{ $bursary->first_name }}</td>
                                                <td>{{ $bursary->last_name }}</td>
                                                <td>{{ $bursary->institution_name }}</td>

                                                <td>{{ $bursary->total_fees_paid }}</td>
                                                <td>{{ $bursary->fee_balance }}</td>
                                                <td>{{ $bursary->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $bursary->updated_at->format('Y-m-d') }}</td>
                                                <td>
                                                    @if ($bursary->status == '0')
                                                        <span class="btn-sm btn btn-warning">Pending</span>
                                                    @elseif($bursary->status == '1')
                                                        <span class="btn-sm btn btn-success">Approved</span>
                                                    @else
                                                        <span class="btn-sm btn btn-danger">Rejected</span>
                                                    @endif
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td class="fas fa-folder-open"> Empty Application History</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        </tr>
                                    </tfoot>
                                </table>
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

    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('Admin/dist/js/demo.js') }}"></script>
@endsection
