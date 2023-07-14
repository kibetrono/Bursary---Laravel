@extends('layouts.app')

@section('title')
    Counties
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
$startIndex = ($counties->currentPage() - 1) * $counties->perPage();
@endphp

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Counties</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Counties</li>
                        </ol>
                    </div>
                </div>
                <div class="row pt-2">
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
                                <h3 class="card-title">Counties</h3>
                                <div class="card-tools">
                                    
                                </div>
                            </div>

                            <div class="card-header mt-1">
                                <h3 class="card-title"><i class="fas fa-map-marker"></i> County Lists</h3>

                                <div class="card-tools">
                                    <form action="{{ route('county.index') }}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="county_search" value="{{request('county_search')}}"
                                                class="form-control float-right" placeholder="Search by name">

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
                                <table class="table table-hover text-nowrap table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">#</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:20%">County Number</th>
                                            <th style="width:20%">Date Created</th>
                                            <th style="width:20%">Date Updated</th>
                                            @canany(['create location', 'update location', 'delete location'])
                                                <th class="d-flex justify-content-center"> Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($counties as $index => $county)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $county->name }}</td>
                                                <td>{{ $county->county_number }}</td>
                                                <td>{{ $county->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $county->updated_at->format('Y-m-d') }}</td>
                                                @canany(['create location', 'update location', 'delete location'])
                                                    <td class="text-end">
                                                        <div class="d-flex justify-content-center">
                                                            @can('update location')
                                                                <a href="{{ route('county.edit', encrypt($county->id)) }}" class="btn-sm btn btn-warning mx-1" title="Update"><i class="fas fa-edit"></i></a>
                                                            @endcan
                                                            @can('delete location')
                                                                <form class="mx-1" onclick="return confirm('Are you sure you want to delete {{ $county->name }}?')" action="{{ route('county.destroy', $county->id) }}" method="POST" title="Delete">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn-sm btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                @endcanany
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-bold">
                                                    <i class="fas fa-folder-open"></i> No County Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($counties->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $counties->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $counties->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($counties->getUrlRange(1, $counties->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $counties->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$counties->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $counties->nextPageUrl() }}"
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
