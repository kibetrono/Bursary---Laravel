@extends('layouts.app')

@section('title')
    Create New Staff
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
            <h3>Add New Staff</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">
                <a href="{{route('staff_users.list')}}">Staffs</a>
              </li>
              <li class="breadcrumb-item active">Add New Staff
              </li>
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
                <h3 class="card-title">Add New Staff</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form style="padding:20px;" action="{{ route('admin/staff_users/save') }}" method="POST">
                @csrf

                <div class="row">
                    <label for="">Username</label>

                    <div class="input-group mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="">Email Address</label>
                    <div class="input-group mb-3">
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">

                        <input id="telephone" type="number"
                            class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                            placeholder="Telephone number" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <label for="">Password</label>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label for="">Confirm Password</label>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" name="password_confirmation"
                            class="form-control" placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label for="">Role</label>
                    <div class="input-group mb-3">
                        <select name="role" id="select_role" readonly class="form-control">
                            @foreach ($role as $staff_role)
                            <option value="{{$staff_role->id}}">{{$staff_role->name}}</option>
                            @endforeach
                        
                        </select>
                
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-tasks"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button style="border:unset" type="submit" class="btn-sm btn btn-success btn-block">Create Staff</button>
                    </div>

                   
                </div>

            </form>
            </div>
            <!-- /.card -->

        

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
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

<script src="{{url('Admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{url('Admin/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('Admin/dist/js/demo.js')}}"></script>

{{-- select 2 --}}

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@endsection