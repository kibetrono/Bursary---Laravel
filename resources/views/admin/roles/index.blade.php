@extends('layouts.app')

@section('title')
    Roles
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
$startIndex = ($roles->currentPage() - 1) * $roles->perPage();
@endphp
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
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
                                <h3 class="card-title">Roles</h3>

                                <div class="card-tools">
                                    {{-- <a href="{{ route('role.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New
                                        Role</a> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-1">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role</th>
                                            {{-- <th>Permission(s)</th> --}}
                                            <th>Date Posted</th>
                                            <th>Date Updated</th>
                                            @canany(['view role', 'edit role', 'delete row'])
                                            <th>Action</th> 
                                            @endcanany
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $index => $role)
                                            <tr>
                                                <td>{{ $startIndex + $index + 1 }}</td>
                                                <td>{{ $role->name }}</td>
                                                {{-- <td>
                                                @foreach ($role->permissions as $permission)
                                                <button class="btn-sm btn btn-warning" role="button"><i class="fas fa-shield-alt"></i> {{$permission->name}}</button>
                                                @endforeach
                                            </td> --}}
                                                <td><span
                                                        class="tag tag-success">{{ $role->created_at->format('Y-m-d') }}</span>
                                                </td>
                                                <td><span
                                                        class="tag tag-success">{{ $role->updated_at->format('Y-m-d') }}</span>
                                                </td>
                                            @canany(['view role', 'edit role', 'delete row'])
                                                <td class="d-flex">
                                                    @can('view role')                                                    
                                                    <a href="{{ route('role.show', encrypt($role->id)) }}"
                                                        class="btn-sm btn btn-info mx-1"><i class="fas fa-eye"></i></a>
                                                    @endcan
                                                    @can('edit role')                                                    
                                                    <a href="{{ route('role.edit', encrypt($role->id)) }}"
                                                        class="btn-sm btn btn-warning mx-1"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete role')                                                    
                                                    <form class="mx-1"
                                                        onclick="return confirm('Are you sure you want to delete {{ $role->name }} role ?')"
                                                        action="{{ route('role.destroy', $role->id) }}" method="POST">
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
                                                <td class="fas fa-folder-open"> No Role Found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        @if ($roles->hasPages())
                                            <div class="d-flex justify-content-end">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination">
                                                        {{-- Previous Page Link --}}
                                                        <li
                                                            class="page-item {{ $roles->onFirstPage() ? 'disabled' : '' }}">
                                                            <a class="page-link"
                                                                href="{{ $roles->previousPageUrl() }}"
                                                                aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>

                                                        {{-- Numbered Page Links --}}
                                                        @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                                                            <li
                                                                class="page-item {{ $roles->currentPage() === $page ? 'active' : '' }}">
                                                                <a class="page-link"
                                                                    href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endforeach

                                                        {{-- Next Page Link --}}
                                                        <li
                                                            class="page-item {{ !$roles->hasMorePages() ? 'disabled' : '' }}">
                                                            <a class="page-link" href="{{ $roles->nextPageUrl() }}"
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
