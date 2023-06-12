@extends('layouts.app')

@section('title')
{{ $data->first_name}} {{ $data->last_name}}
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">
    <style>
        input{
            background-color: #F4F6F9;
            border: unset;
            border-radius: 5px;
            padding-left: 8px
        }
        input:focus{
            outline: none
        }
    </style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Applicant: {{ $data->first_name}} {{ $data->last_name}}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('bursary.index') }}">Bursary applications</a>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Applicants Information</h3>
                                <div class="card-tools">
                                    {{-- <a href="{{ route('user.create') }}" class="btn-sm btn btn-success"><i
                                            class="fas fa-plus-circle"></i> Create New User</a> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4"></div><div class="col-md-4"><h5>Personal Information</h5></div><div class="col-md-4"></div>
                                   
                                    <div class="col-md-12">
                                    {{-- <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
    
                                           <tr>
                                            <td>
                                               <p> Name: {{$data->first_name}} {{$data->last_name}} </p>
                                               <p>  Gender: {{ucfirst($data->gender)}} </p>
                                                <p> DOB : {{\Carbon\Carbon::parse($data->date_of_birth)->format('Y-m-d')}} </p>
                                                <p> Telephone number: {{$data->telephone_number}} </p>
                                                <p> First Name: {{$data->first_name}} </p>
                                            </td>
                                            <td>Last Name: {{$data->last_name}}</td>
                                            <td>Gender: {{ucfirst($data->gender)}}</td>
                                            <td>DOB: {{ \Carbon\Carbon::parse($data->date_of_birth)->format('Y-m-d')}}</td>
                                            <td>Last Name:{{$data->last_name}}</td>
                                           </tr>
                                           
                                           
    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table> --}}
                                </div>


                                    {{-- <div class="col-md-4">
                                        <label for="">Firstname</label>
                                        <input type="text" value="{{$data->first_name}}" readonly> <br>
                                        <label for="">Lastname</label> 
                                        <input type="text" value="{{$data->last_name}}" readonly> <br>
                                        <label for="">Gender</label>
                                        <input type="text" value="{{ucfirst($data->gender)}}" readonly> <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">ID.Passport no.</label>
                                        <input type="text" value="{{$data->first_name}}" readonly> <br>
                                        <label for="">Lastname</label> 
                                        <input type="text" value="{{$data->last_name}}" readonly> <br>
                                        <label for="">Gender</label>
                                        <input type="text" value="{{ucfirst($data->gender)}}" readonly> <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Firstname</label>
                                        <input type="text" value="{{$data->first_name}}" readonly> <br>
                                        <label for="">Lastname</label> 
                                        <input type="text" value="{{$data->last_name}}" readonly> <br>
                                        <label for="">Gender</label>
                                        <input type="text" value="{{ucfirst($data->gender)}}" readonly> <br>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <h5>Family Background Information</h5>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <h5>School Details</h5>
                                    </div>
                                    <div class="col-md-4"></div>
                                     
                                </div>

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <h5>Key Attachments</h5>
                                    </div>
                                    <div class="col-md-4"></div>

                                </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <form action="">
                                            <button style="border-radius:4px" class="btn-sm btn btn-success">Approve Application</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="">
                                            <button style="border-radius:4px" class="btn-sm btn btn-danger">Reject Application</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('Admin/dist/js/demo.js') }}"></script>
@endsection
