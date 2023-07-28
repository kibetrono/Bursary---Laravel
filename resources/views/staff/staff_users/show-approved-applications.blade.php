@extends('layouts.app')

@section('title')
    {{$user->name}} Approved Bursary Applications
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
@endsection
@php
$startIndex = ($approvedBursaries->currentPage() - 1) * $approvedBursaries->perPage();
@endphp
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>{{$user->email}}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('staff.show', encrypt($user->id)) }}">{{$user->name}}</a>
                            </li>
                            <li class="breadcrumb-item active">Approved Application List</li>
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
                                <h3 class="card-title">Applications Approved By: {{$user->name}}</h3>
                                <div class="card-tools">
                                    <form action="{{ route('staff.view.approved.applications',encrypt($user->id)) }}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="approved_search_by_staff" value="{{$searchTerm}}" class="form-control"
                                                placeholder="search by adm/reg number" autocomplete="off">

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
                            <div class="card-body table-responsive p-1">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Institution</th>
                                            <th>Adm/Reg no.</th>
                                            <th>Total Fees</th>
                                            <th>Paid</th>
                                            <th>Balance</th>
                                            <th>Date Applied</th>
                                            <th>Date Approved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($approvedBursaries as $index =>$approvedBursary)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $approvedBursary->first_name }} {{ $approvedBursary->last_name }}</td>
                                                <td>{{ $approvedBursary->gender }}</td>
                                                <td>{{ $approvedBursary->institution_name }}</td>
                                                <td>{{ $approvedBursary->adm_or_reg_no }}</td>
                                                <td>{{ $approvedBursary->total_fees_payable }}</td>
                                                <td>{{ $approvedBursary->total_fees_paid }}</td>
                                                <td>{{ $approvedBursary->fee_balance }}</td>
                                                <td>{{ $approvedBursary->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $approvedBursary->updated_at->format('Y-m-d') }}</td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="fas fa-folder-open"> No Application Approved By {{ucfirst($user->name)}}</td>
                                                <td></td>
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
                                            <td></td>

                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($approvedBursaries->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $approvedBursaries->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $approvedBursaries->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($approvedBursaries->getUrlRange(1, $approvedBursaries->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $approvedBursaries->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$approvedBursaries->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $approvedBursaries->nextPageUrl() }}"
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
