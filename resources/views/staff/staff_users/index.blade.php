@extends('layouts.app')

@section('title')
    Users
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
                        <h1>Staffs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Staffs</li>
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
                                <h3 class="card-title">Staffs</h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <div class="card-header mt-2">
                                <div class="card-tools mx-4 my-1">
                                    <form action="{{route('staff_users.list')}}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="staff_user_search" value="{{ $searchTerm }}"
                                                class="form-control float-right"  placeholder="Search by name or email">

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
                                            <th style="width:10%">#</th>
                                            <th style="width:12%">Name</th>
                                            <th style="width:25%">email</th>
                                            <th style="width:25%">Date created</th>
                                            <th style="width:50%">Date updated</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($staffUsers as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $user->updated_at->format('Y-m-d') }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('staff.users.show', $user->id) }}"
                                                        class="btn-sm btn btn-info mx-1" title="View"><i class="fas fa-eye"></i></a>
                                                    
                                                    <form class="mx-1" action="{{ route('staff.users.edit', $user->id) }}" method="POST" title="Edit">
                                                        @csrf
                                                        <button class="btn-sm btn btn-warning" type="submit"><i
                                                                class="fas fa-edit"></i></button>
                                                    </form>

                                                    <form class="mx-1" onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')"
                                                        action="{{ route('staff.users.delete', $user->id) }}" method="POST" title="Delete">
                                                        @csrf
                                                        @method('PUT')

                                                        <button class="btn-sm btn btn-danger" type="submit"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>

                                            


                                        @empty

                                            <tr>
                                                <td class="fas fa-folder-open"> No User Found</td>
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
