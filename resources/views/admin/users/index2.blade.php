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
                        <h1>Users List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users List</li>
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
                                <h3 class="card-title">Users List</h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>

                            <div class="card-header mt-2">
                                <h3 class="card-title"><i class="fas fa-users"></i> Users</h3>




                                <div class="card-tools mx-4 my-1">
                                    <form action="{{ route('user.index') }}" method="GET">

                                        <div class="input-group input-group-sm">
                                            <input type="text" name="user_search" value="{{ $searchTerm }}"
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
                            <div class="card-section p-3">
                                <form action="{{ route('user.index') }}" method="GET">
                                    <div class="form-section">
                                        <div class="row">
                                            <div class="col-md-12 m-1">
                                                <h5 class="text-center text-bold">Personal Details</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group id required">
                                                    <label class="control-label" for="id">ID:</label>
                                                    <input type="text" id="id" class="form-control" name="id"
                                                        aria-required="true" placeholder="ID" >
                                                        
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group name required">
                                                    <label class="control-label" for="name">Name:</label>
                                                    <input type="text" id="name" value={{$name}} class="form-control" name="name"
                                                        aria-required="true" placeholder="Name">
                                                       
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-4">
                                                <div class="form-group email required">
                                                    <label class="control-label" for="email">Email:</label>
                                                    <input type="text" id="email" value={{$email}} class="form-control"
                                                        name="email" aria-required="true"
                                                        placeholder="Email">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group user_type required">
                                                    <label class="control-label" for="user_type">User_type:</label>
                                                    <input type="text" id="user_type" value={{$user_type}} class="form-control"
                                                        name="user_type" aria-required="true"
                                                        placeholder="User Type">
                                                </div>
                                            </div>
                                            
                                            
                                        </div> {{--end of row--}}
                                        <button class="btn-sm btn btn-success">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">ID</th>
                                            <th style="width:12%">Name</th>
                                            <th style="width:12%">Role</th>
                                            <th style="width:25%">email</th>
                                            <th style="width:25%">Date created</th>
                                            <th style="width:50%">Date updated</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @forelse ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @empty
                                                        -
                                                    @endforelse

                                                </td>
                                                <td> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $user->updated_at->format('Y-m-d') }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('user.show', $user->id) }}"
                                                        class="btn-sm btn btn-info mx-1" title="View"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn-sm btn btn-warning mx-1" title="Update"><i class="fas fa-edit"></i></a>

                                                    <form class="mx-1"
                                                        onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')"
                                                        action="{{ route('user.destroy', $user->id) }}" method="POST" title="Delete">
                                                        @csrf
                                                        @method('DELETE')

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
