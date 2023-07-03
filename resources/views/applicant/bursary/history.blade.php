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

@php
$startIndex = ($bursaries->currentPage() - 1) * $bursaries->perPage();
@endphp

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>History - {{ Auth::user()->email }}</h1>
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
                                <h3 class="card-title">Bursary Application History </h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-header">
                                {{-- <h3 class="card-title"><i class="fas fa-history"></i> Bursary Application History</h3> --}}

                                <div class="card-tools my-1">
                                    {{-- <form action="{{ route('user.bursary.history',encrypt(Auth::user()->id)) }}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="user_status_search" value="{{$searchTerm}}" class="form-control"
                                                placeholder="search by status" autocomplete="off">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form> --}}
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-1">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr> 
                                            <th style="width:5%">#</th>
                                            <th style="width:12%">First Name</th>
                                            <th style="width:12%">Last Name</th>
                                            <th style="width:20%">School</th>
                                            <th style="width:10%">Fees Paid</th>
                                            <th style="width:10%">Balance</th>
                                            <th style="width:10%">Date applied</th>
                                            <th style="width:10%">Date updated</th>
                                            <th style="width:auto">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bursaries as $index=>$bursary)
                                        @php
                                            $trimmed_school = strlen($bursary->institution_name) > 20 ? substr($bursary->institution_name, 0, 20) . '...' : $bursary->institution_name;
                                            $trimmed_fName = strlen($bursary->first_name) > 15 ? substr($bursary->first_name, 0, 15) . '...' : $bursary->first_name;
                                            $trimmed_lName = strlen($bursary->last_name) > 15 ? substr($bursary->last_name, 0, 15) . '...' : $bursary->last_name;
                                        @endphp
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $trimmed_fName}}</td>
                                                <td>{{ $trimmed_lName }}</td>
                                                <td>{{ $trimmed_school }}</td>

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
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="fas fa-folder-open"> Empty Application History</td>
                                        
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
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
                                            <td></td>

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
@endsection
