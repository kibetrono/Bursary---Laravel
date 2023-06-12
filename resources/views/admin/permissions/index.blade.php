@extends('layouts.app')

@section('title')
    Permissions
@endsection

@section('css')
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('Admin/plugins/fontawesome-free/css/all.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('Admin/dist/css/adminlte.min.css')}}">

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permissions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Permissions</li>
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
                                <h3 class="card-title">Permissions</h3>

                                <div class="card-tools">
                                    {{-- <a href="{{ route('permission.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New
                                        Permission</a> --}}
                                </div>
                            </div>
                            
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap mt-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Date Posted</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($permissions as $index => $permission)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->created_at->format('Y-m-d')}}</td>
                                            <td class="d-flex">
                                                {{-- <a href="{{route('permission.show',$permission->id)}}" class="btn-sm btn btn-info"><i class="fas fa-eye"></i></a> --}}

                                                <form class="mx-1" onclick="return confirm('Are you sure you want to delete {{$permission->name}} permission ?')" action="{{route('permission.destroy', $permission->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                
                                                    <button class="btn-sm btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                                </form>
                                                {{-- <a href="" class="btn-sm btn btn-danger"><i class="fas fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                        @empty

                                        <tr>
                                            <td class="fas fa-folder-open"> No Permission(s) Found</td>
                                        </tr>
                                            
                                        @endforelse
                                        

                                    </tbody>
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
<script src="{{url('Admin/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{url('Admin/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('Admin/dist/js/demo.js')}}"></script>

@endsection
