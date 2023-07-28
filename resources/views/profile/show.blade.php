@extends('layouts.app')

@section('title')
    User: {{ $user->name }}
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
                        <h4>Email: {{ $user->email }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>

                            @foreach ($user->roles as $role)
                                @if ($role->name == '')
                                    <li class="breadcrumb-item active">
                                        <a href="{{ route('user.index') }}">Users</a>
                                    </li>
                                @endif
                            @endforeach
                            <li class="breadcrumb-item active">{{ $user->email }}</li>
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
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header d-flex">

                                <a href="{{ route('profile.edit', encrypt($user->id)) }}" class="btn-sm btn btn-primary"><i
                                        class="fas fa-edit"></i> Update</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-1">
                                <table class="table table-striped table-bordered">
                                    <thead>

                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td style="width: 30%"><b>Username</b> </td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%"><b>Email Address</b> </td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%"><b>Date Created</b> </td>
                                            <td>{{ $user->created_at }}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%"><b>Date Updated</b> </td>
                                            <td>{{ $user->updated_at }}</td>
                                        </tr>
                                        @if (Auth::user()->roles->count() != 0)
                                            <tr>
                                                <td style="width: 30%"><b>Role</b> </td>
                                                <td>
                                                    @forelse ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @empty
                                                        -
                                                    @endforelse
                                                </td>
                                            </tr>
                                        @endif

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
