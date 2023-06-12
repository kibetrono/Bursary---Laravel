@extends('layouts.app')

@section('title')
    Update Role
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
            <h3>Update Role: {{$role->name}}</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('role.index')}}">Roles</a></li>
              <li class="breadcrumb-item"><a href="{{route('role.show',$role->id)}}">{{$role->id}}</a></li>
              <li class="breadcrumb-item active">Update</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Update Role: {{$role->name}}</h3>
                <div class="card-tools">
                    
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('role.update',$role->id)}}">
                @csrf
                @method("PUT")
                <div class="card-body">
                  <div class="form-group">
                    <label for="role name">Role Name</label>
                    <input type="text"readonly name='name' id="name" class="form-control @error('name') is-invalid @enderror" value="{{$role->name}}" placeholder="Role Name" autocomplete="off">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="permission name">List of Permissions</label>
                    <br>
                    <div class="px-4">
                    @foreach($permissions as $permission)
                        
                        <input id="{{$permission->name}}" class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                        <label style="font-weight:normal" for="{{$permission->name}}">{{ $permission->name }}</label>
                    
                        <br>
                    @endforeach
                </div>
                  </div>

                  <div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer px-0">
                  <button type="submit" class="btn-md btn btn-success"><i class="fas fa-save"></i> Update Role</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->

          
          <!--/.col (right) -->
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