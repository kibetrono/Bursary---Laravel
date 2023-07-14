@extends('layouts.app')

@section('title')
  Update County: {{$county->name}}
@endsection

@section('css')
      <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('Admin/plugins/fontawesome-free/css/all.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('Admin/dist/css/adminlte.min.css')}}">

  {{-- custom css --}}
  <link rel="stylesheet" href="{{url('Admin/css/main.css')}}">
 

@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Update County</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item active">
              <a href="{{route('county.index')}}">Counties</a>
            </li>
            <li class="breadcrumb-item active">Update</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="row px-3">
    <div class="col-sm-12">
        @include('layouts.flash-messages')
    </div>

</div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Update County: {{$county->name}}</h3>
              <div class="card-tools">
              </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form  action="{{ route('county.update',$county->id) }}"  method="POST" class="my-4">
              @csrf
              @method('PUT')
              <div class="row">
                  
                  <label for="" class="px-4">County Name</label>
                  <div class="input-group mb-3 px-4">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$county->name}}" required autocomplete="name" autofocus placeholder="Ward name">
                     
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <label for="" class="px-4">County Number</label>
                  <div class="input-group mb-3 px-4">
                      <input id="county_number" type="number" class="form-control @error('county_number') is-invalid @enderror" name="county_number" value="{{$county->county_number}}" required autocomplete="county_number" autofocus placeholder="County number">
                     
                      @error('county_number')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>

                  <div class="px-4">
                      <button style="border:unset" type="submit" class="btn-md btn btn-success btn-block"><i class="fas fa-edit"></i> Update County</button>
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
@endsection