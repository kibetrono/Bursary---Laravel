@extends('layouts.app')

@section('title')
    Apply Bursary
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

    <style>
        .progress-bar {
    width: 0%;
    background-color: #007bff;
    height: 5px;
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
                        <h1>Apply Bursary</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Apply Bursary</li>
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
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Apply Bursary</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form id="myForm" method="POST" action="">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                    <!-- Step 1: Personal Details -->
                                    <div id="step1" class="step">
                                        <label for="firstname">First Name</label>
                                        <input type="text" name="firstname" class="form-control" required>

                                        <label for="lastname">Last Name</label>
                                        <input type="text" name="lastname" class="form-control">
                                    </div>
                                
                                    <!-- Step 2: School Details -->
                                    <div id="step2" class="step">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" required>

                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                
                                    <!-- Step 3: Other Details -->
                                    <div id="step3" class="step">
                                        <label for="message">Message</label> <br>
                                        <textarea name="message" id="" cols="30" rows="10" required></textarea>
                                    </div>
                                
                                    <!-- ... -->
                                
                                    <div class="form-actions">
                                        <button type="button" class="btn" id="prevBtn" onclick="prevStep()">Previous</button>
                                        <button type="button" class="btn" id="nextBtn" onclick="nextStep()">Next</button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                                    </div>
                                </form>
                                
                            </div>
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
    <script src="{{ url('Admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('Admin/dist/js/demo.js') }}"></script>
    
    {{-- select 2 --}}

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            // Initialize Select2
            $('#bank_name').select2();

            // Set option selected onchange
            $('#user_selected').change(function() {
                var value = $(this).val();

                // Set selected 
                $('#bank_name').val(value);
                $('#bank_name').select2().trigger('change');

            });
        });
    </script>
    {{-- /select 2 --}}

    {{-- parsley js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- /parsley js --}}

   <script>
    $(document).ready(function() {
    // Initialize Parsley.js on your form
    $('#myForm').parsley();

    // Configure Parsley.js to validate each step separately
    $('.step').parsley({
        // Change error class for highlighting errors
        errorClass: 'is-invalid',

        // Change success class for valid fields
        successClass: 'is-valid',

        // Trigger validation on each field only when navigating to the next step
        trigger: 'change',
        excluded: 'input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden',

        // Prevent submitting the form if there are validation errors
        preventSubmit: true
    });

    // Update progress indicator on document load
    updateProgress();
});

function updateProgress() {
    var totalSteps = $('.step').length;
    var completedSteps = $('.step').filter('.is-valid').length;
    var progressPercentage = (completedSteps / totalSteps) * 100;

    // Update your progress indicator element here
    // For example, you can update a progress bar's width or a step indicator's status
    $('.progress-bar').css('width', progressPercentage + '%');
}

function nextStep() {
    if ($('#myForm').parsley().validate({ group: 'step' })) {
        var currentStep = $('.step:visible');
        var nextStep = currentStep.next('.step');
        
        currentStep.hide();
        nextStep.show();

        updateProgress();
    }
}

function prevStep() {
    var currentStep = $('.step:visible');
    var prevStep = currentStep.prev('.step');

    currentStep.hide();
    prevStep.show();

    updateProgress();
}

   </script>
@endsection
