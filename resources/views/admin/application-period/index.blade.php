@extends('layouts.app')

@section('title')
    Application Periods
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
$startIndex = ($application_periods->currentPage() - 1) * $application_periods->perPage();
@endphp

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Application Periods</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Application Periods</li>
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
                                <h3 class="card-title">Application Periods </h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-1">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Finacial Year</th>
                                            <th>Application Period From</th>
                                            <th>Application Period To</th>
                                            <th>Date created</th>
                                            <th>Date updated</th>
                                            <th>Status</th>
                                            @canany(['update application period', 'delete application period'])
                                            <th>Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($application_periods as $index =>$application_period)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $application_period->financial_year }}</td>
                                                <td>{{ \Carbon\Carbon::parse($application_period->period_from)->format('Y-m-d') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($application_period->period_to)->format('Y-m-d') }}
                                                </td>
                                                <td>{{ $application_period->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $application_period->updated_at->format('Y-m-d') }}</td>
                                                <td>
                                                    @if ($application_period->status == '0')
                                                        <span class="p-1 btn-sm btn btn-secondary">Inactive</span>
                                                    @else
                                                        <span class="p-1 btn-sm btn btn-success">Active</span>
                                                    @endif
                                                </td>
                                                @canany(['update application period', 'delete application period'])

                                                <td class="d-flex">
                                                    @can('update application period')
                                                    <a href="{{ route('application-period.edit', encrypt($application_period->id)) }}"
                                                        class="btn-sm btn btn-warning mx-1" title="Update"><i
                                                            class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete application period')
                                                    <form class="mx-1"
                                                        onclick="return confirm('Are you sure you want to delete {{ $application_period->name }}?')"
                                                        action="{{ route('application-period.destroy', encrypt($application_period->id)) }}"
                                                        method="POST" title="Delete">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn-sm btn btn-danger" type="submit"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                    @endcan
                                                </td>
                                                @endcanany
                                            </tr>


                                        @empty

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="fas fa-folder-open"> No Settings Applied</td>
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

                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($application_periods->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $application_periods->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $application_periods->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($application_periods->getUrlRange(1, $application_periods->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $application_periods->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$application_periods->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $application_periods->nextPageUrl() }}"
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
