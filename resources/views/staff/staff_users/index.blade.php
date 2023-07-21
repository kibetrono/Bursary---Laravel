@extends('layouts.app')

@section('title')
    Staffs
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
$startIndex = ($staffUsers->currentPage() - 1) * $staffUsers->perPage();
@endphp

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Staff List</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Staffs</li>
                        </ol>
                    </div>
                </div>
                <div class="row mt-1">
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
                                <h3 class="card-title">Staffs</h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <div class="card-header mt-1">
                                <div class="card-tools">
                                    <form action="{{ route('staff.index') }}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="staff_user_search" value="{{ request('staff_user_search') }}"
                                                class="form-control float-right" placeholder="Search by name or email">

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
                                            <th style="width:10%">#</th>
                                            <th style="width:12%">Name</th>
                                            <th style="width:25%">email</th>
                                            <th style="width:25%">Date created</th>
                                            <th style="width:50%">Date updated</th>
                                            @canany(['view staff', 'edit staff', 'delete staff'])
                                            <th class="text-end">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($staffUsers as $index => $user)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $user->updated_at->format('Y-m-d') }}</td>
                                                @canany(['view staff', 'edit staff', 'delete staff'])

                                                <td class="d-flex">
                                                    @can('view staff')
                                                    <a href="{{ route('staff.show', encrypt($user->id)) }}"
                                                        class="btn-sm btn btn-info mx-1" title="View"><i
                                                            class="fas fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit staff')
                                                    <a href="{{ route('staff.edit', encrypt($user->id)) }}" class="btn-sm btn btn-warning mx-1" title="Update"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete staff')
                                                    <form class="mx-1"
                                                        onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')"
                                                        action="{{ route('staff.destroy', $user->id) }}"
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
                                                <td class="fas fa-folder-open"> No Staff Found</td>
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

                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($staffUsers->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $staffUsers->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $staffUsers->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($staffUsers->getUrlRange(1, $staffUsers->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $staffUsers->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$staffUsers->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $staffUsers->nextPageUrl() }}"
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
