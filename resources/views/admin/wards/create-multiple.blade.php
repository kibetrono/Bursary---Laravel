@extends('layouts.app')

@section('title')
    Create New Ward
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    {{-- /select 2 --}}

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}"> 

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Add Multiple Wards</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <a href="{{ route('ward.index') }}">Wards</a>
                            </li>
                            <li class="breadcrumb-item active">Add Multiple Wards
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
                    <div class="col">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Add New Wards</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('ward.store') }}" method="POST">
                                    @csrf

                                    <label for="">Constituency Name</label>
                                    <div class="input-group mb-3">
                                        <select id="constituency_name" class="form-control @error('constituency_id') is-invalid @enderror"
                                            name="constituency_id" aria-required="true" required>
                                            <option value="" selected disabled>Select constituency</option>
                                            @foreach ($constituencies as $constituency)
                                                <option value="{{ $constituency->id }}">{{ $constituency->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('constituency_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="">Ward Names</label>
                                            <div class="form-group">
                                                <button type="button" id="add-field" class="btn-sm btn btn-primary"><i class="fas fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                        <div id="ward-container">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name[]" required placeholder="Ward name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button style="border: unset" type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Wards</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <script src="{{ url('Admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script>

    {{-- select 2 --}}
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add field button click event
            $('#add-field').click(function() {
                var field = `
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('name.*') is-invalid @enderror" name="name[]" required placeholder="Ward name">
                        <div class="input-group-append">
                            <button type="button" class="btn-sm btn btn-danger remove-field"><i class="fas fa-minus"></i></button>
                        </div>
                        @error('name.*')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                `;
                $('#ward-container').append(field);
            });
    
            // Remove field button click event
            $(document).on('click', '.remove-field', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
    
    <script src="{{ url('Admin/js/locations/select2.js') }}"></script>
    
@endsection
