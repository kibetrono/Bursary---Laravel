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

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Role: {{ $role->name }}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('role.index') }}">Roles</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $role->name }}</li>
                        </ol>
                    </div>
                </div>

            </div><!-- /.container-fluid -->

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card ">
                            <div class="card-header bg-info">

                                <h3 class="card-title">Role - {{ $role->name }}</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    @can('edit role')                                                    
                                    <div class="mb-3">
                                        <a href="{{ route('role.edit', encrypt($role->id)) }}" class="btn-sm btn btn-primary"><i
                                                class="fas fa-edit"></i> Update</a>
                                    </div>
                                    @endcan
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">Role Name</th>
                                            <td>{{ $role->name }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%"><b>Permissions</b> </td>
                                            <td>

                                                @forelse ($role->permissions as $permission)
                                                    - {{ ucfirst($permission->name) }} <br>
                                                @empty
                                                    <p class="fas fa-folder-open" style="font-weight: normal"> No
                                                        Permission(s) Found</p>
                                                @endforelse

                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
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
