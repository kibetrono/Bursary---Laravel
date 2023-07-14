@extends('layouts.app')

@section('title')
    Locations
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
$startIndex = ($locations->currentPage() - 1) * $locations->perPage();
@endphp

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Locations</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Locations</li>
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
                                <h3 class="card-title">Locations</h3>
                                <div class="card-tools">
                                    
                                </div>
                            </div>

                            <div class="card-header mt-1">
                                <h3 class="card-title"><i class="fas fa-map-marker"></i> Location Lists</h3>

                                <div class="card-tools">
                                    <form action="{{ route('location.index') }}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="location_search" value="{{request('location_search')}}"
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
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">#</th>
                                            <th style="width:20%">Name</th>
                                            <th style="width:20%">County Ward</th>
                                            <th style="width:20%">Date Created</th>
                                            <th style="width:20%">Date Updated</th>
                                            @canany(['create location', 'view location', 'update location','delete location'])                                            
                                            <th class="d-flex justify-content-center">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($locations as $index =>$location)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $location->name }}</td>
                                                <td>{{ $location->ward_name }}</td>
                                                <td>{{ $location->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $location->updated_at->format('Y-m-d') }}</td>
                                                @canany(['create location', 'view location', 'update location','delete location'])                                            
                                                <td class="text-end">
                                                    <div class="d-flex justify-content-center">
                                                        @can('update location')
                                                            <a href="{{ route('location.edit', encrypt($location->id)) }}" class="btn-sm btn btn-warning mx-1" title="Update"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('delete location')
                                                            <form class="mx-1" onclick="return confirm('Are you sure you want to delete {{ $location->name }}?')" action="{{ route('location.destroy', $location->id) }}" method="POST" title="Delete">
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
                                                    <i class="fas fa-folder-open"></i> No Location Found
                                                </td>
                                               
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
                                        @if ($locations->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $locations->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $locations->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($locations->getUrlRange(1, $locations->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $locations->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$locations->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $locations->nextPageUrl() }}"
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
