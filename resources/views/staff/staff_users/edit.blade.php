@extends('layouts.app')

@section('title')
    Update Staff: {{$user->name}}
@endsection

@section('css')
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('Admin/plugins/fontawesome-free/css/all.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('Admin/dist/css/adminlte.min.css')}}">

  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  {{-- /select 2 --}}

  {{-- custom css --}}
  <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}">
  <link rel="stylesheet" href="{{ url('Admin/css/staffs/update.css') }}">


@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Update Staff</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">
              <a href="{{route('staff_users.list')}}">Staffs</a>
            </li>
            <li class="breadcrumb-item active">{{$user->email}}</li>
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
              <h3 class="card-title">Update Staff: {{$user->email}}</h3>
              <div class="card-tools">
                  {{-- <a href="{{ route('user.index') }}" class="btn-md btn btn-danger"><i class="fas fa-users"></i> All Users</a> --}}
              </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form  action="{{ route('staff.users.update',$user->id) }}"  method="POST" class="my-4">
              @csrf
              @method('PUT')
              <div class="row">
                  
                  <label for="" class="px-4">Username</label>
                  <div class="input-group mb-3 px-4">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" autofocus placeholder="Username">
                      <div class="input-group-append">
                          <div class="input-group-text"><span class="fas fa-user"></span></div>
                      </div>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <label for="" class="px-4">Email Address</label>
                  <div class="input-group mb-3 px-4">
                      <input id="email" type="email"
                          class="form-control @error('email') is-invalid @enderror" name="email"
                          value="{{$user->email}}" required autocomplete="email" placeholder="Email Address">
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
                  <label for="" class="px-4">Password</label>
                  <div class="input-group mb-3 px-4">
                      <input id="password" type="password"
                          class="form-control @error('password') is-invalid @enderror" name="password"
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
                  <label for="" class="px-4">Confirm Password</label>

                  <div class="input-group mb-3 px-4">
                      <input id="password-confirm" type="password" name="password_confirmation"
                          class="form-control" placeholder="Retype password">
                      <div class="input-group-append">
                          <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                          </div>
                      </div>
                  </div>
                  <label for="" class="px-4">Role</label>
                  <div class="input-group mb-3 px-4">
                    <select class="form-control" id="select_role" name="role">
                      @foreach($roles as $role)
                          <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                              {{ $role->name }}
                          </option>
                      @endforeach
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-tasks"></span>
                    </div>
                </div>
                  </div>

                  <div class="px-4">
                      <button style="border:unset" type="submit" class="btn-md btn btn-success btn-block">Update Staff</button>
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



  {{-- select 2 --}}

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- Custom js -->
<script src="{{ url('Admin/js/users/select2.js') }}"></script>

@endsection