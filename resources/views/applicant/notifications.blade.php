@extends('layouts.app')

@section('title')
    Notifications
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
$startIndex = ($bursaryNotifications->currentPage() - 1) * $bursaryNotifications->perPage();
@endphp
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Notifications</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Notifications</li>
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
                                <h3 class="card-title">Notifications </h3>
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
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($bursaryNotifications as $index=> $notification)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>

                                                <td>
                                                    @if ($notification->status == '1')
                                                        <p> Congratulations, your bursary application for academic year
                                                            {{ $notification->created_at->format('Y') }} has been approved.
                                                            {{ $notification->institution_name }} will receive your funds.
                                                        </p>
                                                    @elseif($notification->status == '2')
                                                        <p> We regret that your bursary application for academic year
                                                            {{ $notification->created_at->format('Y') }} was unsuccessful as
                                                            you did not meet all the requirements needed.</p>
                                                    @endif
                                                </td>

                                                <td>{{ $notification->updated_at->format('Y-m-d') }}</td>
                                                <td>
                                                    @if ($notification->status == '1')
                                                        <span class="btn-sm btn btn-success">Approved</span>
                                                    @elseif($notification->status == '2')
                                                        <span class="btn-sm btn btn-danger">Rejected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td></td>
                                            <td class="text-bold"><i class="fas fa-inbox"></i> Empty Inbox</td>
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
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($bursaryNotifications->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $bursaryNotifications->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $bursaryNotifications->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($bursaryNotifications->getUrlRange(1, $bursaryNotifications->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $bursaryNotifications->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$bursaryNotifications->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $bursaryNotifications->nextPageUrl() }}"
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
