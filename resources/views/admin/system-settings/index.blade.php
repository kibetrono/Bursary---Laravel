@extends('layouts.app')

@section('title')
    System Settings
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/system-setting/index.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>System Settings</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">System Settings</li>
                        </ol>
                    </div>
                </div>
                <div class="row pt-2">
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
                            <div class="card-header bg-info">
                                <h3 class="card-title">System Settings </h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body table-responsive p-1 pt-4">
                                <div class="row">
                                    <div class="col-xl-2 flex-container">
                                        <div class="card sticky-top">
                                            <div class="list-group list-group-flush " id="custom-setting-sidenav">

                                                <a href="#custom-setting-1"
                                                    class="list-group-item list-group-item-action active">{{ __('Brand Setting') }}
                                                    <i class="fas fa-chevron-right arrow-icon"></i>
                                                </a>
                                                <a href="#custom-setting-2"
                                                    class="list-group-item list-group-item-action">{{ __('Email Setting') }}
                                                    <i class="fas fa-chevron-right arrow-icon"></i>
                                                </a>
                                                <a href="#custom-setting-3"
                                                    class="list-group-item list-group-item-action">{{ __('Email Notification') }}
                                                    <i class="fas fa-chevron-right arrow-icon"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-xl-10-content">

                                        <!--Brand Setting-->
                                        <div id="custom-setting-1" class="card">
                                            <div class="card-header">
                                                <h5 class="small-title">{{ __('Brand Setting') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('settings.update.fields') }}"
                                                    accept-charset="UTF-8" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="brand_form" value="1">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-6 col-md-6 dashboard-card">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Logo</h5>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <div class="setting-card">
                                                                        <div class="logo-content mt-2">
                                                                            @if (isset($settingsfields['logo']))
                                                                                <img src="{{ asset('storage/' . $settingsfields['logo']) }}"
                                                                                    alt="Logo">
                                                                            @endif
                                                                        </div>
                                                                        <div class="choose-files mt-2">
                                                                            <label for="full_logo">
                                                                                <div class="bg-info"> <i
                                                                                        class="ti ti-upload px-1"></i>Choose
                                                                                    file here </div>
                                                                                <input type="file" name="logo"
                                                                                    id="full_logo" class="form-control file"
                                                                                    data-filename="full_logo"
                                                                                    onchange="document.getElementById('logo_preview').src = window.URL.createObjectURL(this.files[0])">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-sm-6 col-md-6 dashboard-card">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h5>Favicon</h5>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <div class="setting-card">
                                                                        <div class="logo-content mt-2">
                                                                            @if (isset($settingsfields['favicon']))
                                                                                <img src="{{ asset('storage/' . $settingsfields['favicon']) }}"
                                                                                    alt="Favicon">
                                                                            @endif
                                                                        </div>
                                                                        <div class="choose-files mt-2">
                                                                            <label for="favicon">
                                                                                <div class="bg-info">
                                                                                    <i class="ti ti-upload px-1"></i>Choose
                                                                                    file here
                                                                                </div>
                                                                                <input type="file" name="favicon"
                                                                                    id="favicon" class="form-control file"
                                                                                    data-filename="company_favicon_update"
                                                                                    onchange="document.getElementById('favicon_preview').src = window.URL.createObjectURL(this.files[0])">
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-2 p-2">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title_text" class="form-label">Title
                                                                        Text</label>
                                                                    <input class="form-control" placeholder="Title Text"
                                                                        name="title_text" type="text"
                                                                        value="{{ old('title_text', $settingsfields['title_text'] ?? '') }}"
                                                                        id="title_text">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="footer_text" class="form-label">Footer
                                                                        Text</label>
                                                                    <input class="form-control"
                                                                        placeholder="Enter Footer Text" name="footer_text"
                                                                        type="text"
                                                                        value="{{ old('footer_text', $settingsfields['footer_text'] ?? '') }}"
                                                                        id="footer_text">
                                                                </div>
                                                            </div>
                                                            @can('edit system setting')
                                                                <div class="form-group p-2">
                                                                    <input id='sbmt_btns'
                                                                        class="btn btn-print-invoice btn-info" type="submit"
                                                                        value="Save Changes">
                                                                </div>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!--Email Setting-->
                                        <div id="custom-setting-2" class="card">
                                            <div class="card-header">
                                                <h5 class="small-title">{{ __('Email Setting') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('settings.update.fields') }}"
                                                    accept-charset="UTF-8">
                                                    @csrf
                                                    <input type="hidden" name="email_form" value="1">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_driver" class="form-label">Mail
                                                                    Driver</label>
                                                                <input class="form-control"
                                                                    placeholder="Enter Mail Driver" name="mail_driver"
                                                                    type="text"
                                                                    value="{{ old('mail_driver', $settingsfields['mail_driver'] ?? '') }}"
                                                                    id="mail_driver">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_host" class="form-label">Mail
                                                                    Host</label>
                                                                <input class="form-control " placeholder="Enter Mail Host"
                                                                    name="mail_host" type="text"
                                                                    value="{{ old('mail_host', $settingsfields['mail_host'] ?? '') }}"
                                                                    id="mail_host">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_port" class="form-label">Mail
                                                                    Port</label>
                                                                <input class="form-control" placeholder="Enter Mail Port"
                                                                    name="mail_port" type="number"
                                                                    value="{{ old('mail_port', $settingsfields['mail_port'] ?? '') }}"
                                                                    id="mail_port">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_username" class="form-label">Mail
                                                                    Username</label>
                                                                <input class="form-control"
                                                                    placeholder="Enter Mail Username" name="mail_username"
                                                                    type="text"
                                                                    value="{{ old('mail_username', $settingsfields['mail_username'] ?? '') }}"
                                                                    id="mail_username">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_password" class="form-label">Mail
                                                                    Password</label>
                                                                <input class="form-control"
                                                                    placeholder="Enter Mail Password" name="mail_password"
                                                                    type="text"
                                                                    value="{{ old('mail_password', $settingsfields['mail_password'] ?? '') }}"
                                                                    id="mail_password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_encryption" class="form-label">Mail
                                                                    Encryption</label>
                                                                <input class="form-control"
                                                                    placeholder="Enter Mail Encryption"
                                                                    name="mail_encryption" type="text"
                                                                    value="{{ old('mail_encryption', $settingsfields['mail_encryption'] ?? '') }}"
                                                                    id="mail_encryption">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_from_address" class="form-label">Mail
                                                                    From Address</label>
                                                                <input class="form-control"
                                                                    placeholder="Enter Mail From Address"
                                                                    name="mail_from_address" type="text"
                                                                    value="{{ old('mail_from_address', $settingsfields['mail_from_address'] ?? '') }}"
                                                                    id="mail_from_address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="mail_from_name" class="form-label">Mail From
                                                                    Name</label>
                                                                <input class="form-control"
                                                                    placeholder="Enter Mail From Name"
                                                                    name="mail_from_name" type="text"
                                                                    value="{{ old('mail_from_name', $settingsfields['mail_from_name'] ?? '') }}"
                                                                    id="mail_from_name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @can('edit system setting')
                                                        <div class="row mt-2">
                                                            <div class="form-group col-md-6">
                                                                <a href="#" id="sbmt_btns"
                                                                    class="btn btn-info send_email" data-toggle="modal"
                                                                    data-target="#testEmailModal">
                                                                    Send Test Mail
                                                                </a>
                                                            </div>
                                                            <div class="form-group col-md-6 text-end">
                                                                <input id="sbmt_btns" class="btn btn-info" type="submit"
                                                                    value="Save Changes">
                                                            </div>
                                                        </div>
                                                    @endcan

                                                </form>
                                            </div>
                                        </div>

                                        <!--Email Notification-->
                                        <div id="custom-setting-3" class="card">
                                            <div class="card-header">
                                                <h5 class="small-title">{{ __('Email Action Notification') }}</h5>
                                            </div>

                                            <div class="card-body">
                                                <form method="POST" id="email_notification_row"
                                                    action="{{ route('settings.update.fields') }}"
                                                    accept-charset="UTF-8">
                                                    @csrf
                                                    <input type="hidden" name="email_notification_form" value="1">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="user_signup"
                                                                    class="form-label switch-label">Creating
                                                                    Account</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="user_signup"
                                                                        name="user_signup" value="1"
                                                                        @if ($settingsfields['user_signup'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="create_user"
                                                                    class="form-label switch-label">Creating User</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="create_user"
                                                                        name="create_user" value="1"
                                                                        @if ($settingsfields['create_user'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="create_staff"
                                                                    class="form-label switch-label">Creating Staff</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="create_staff"
                                                                        name="create_staff" value="1"
                                                                        @if ($settingsfields['create_staff'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="apply_bursary"
                                                                    class="form-label switch-label">Applying
                                                                    Bursary</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="apply_bursary"
                                                                        name="apply_bursary" value="1"
                                                                        @if ($settingsfields['apply_bursary'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="approve_bursary"
                                                                    class="form-label switch-label">Approving
                                                                    Bursary</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="approve_bursary"
                                                                        name="approve_bursary" value="1"
                                                                        @if ($settingsfields['approve_bursary'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="reject_bursary"
                                                                    class="form-label switch-label">Rejecting
                                                                    Bursary</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="reject_bursary"
                                                                        name="reject_bursary" value="1"
                                                                        @if ($settingsfields['reject_bursary'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group switch-container">
                                                                <label for="role_assigned"
                                                                    class="form-label switch-label">Assigning Role</label>
                                                                <label class="switch">
                                                                    <input type="checkbox" id="role_assigned"
                                                                        name="role_assigned" value="1"
                                                                        @if ($settingsfields['role_assigned'] ?? 0) checked @endif>
                                                                    <div class="switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @can('edit system setting')
                                                        <div class="row mt-2">
                                                            <div class="form-group col-md-6 text-end">
                                                                <input class="btn btn-info" id="sbmt_btns" type="submit"
                                                                    value="Save Changes">
                                                            </div>
                                                        </div>
                                                    @endcan

                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="testEmailModal" tabindex="-1" role="dialog"
                        aria-labelledby="testEmailModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testEmailModalLabel">Send Test Email</h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="loadingMessage">
                                    <div class="loading-container">
                                        <strong>
                                            <i class="fas fa-spinner fa-spin"></i> &nbsp; Sending...
                                        </strong>
                                    </div>
                                </div>

                                <div class="modal-body">
                                    <form id="testEmailForm" method="post"
                                        action="{{ route('send-configuration-test-email') }}">
                                        @csrf
                                        <div id="app" data-csrf-token="{{ csrf_token() }}">
                                            <div class="form-group">
                                                <label for="testEmailSubject">Subject:</label>
                                                <input type="text" class="form-control" id="testEmailSubject"
                                                    name="subject" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="testEmailBody">Body:</label>
                                                <textarea class="form-control" id="testEmailBody" name="body" rows="2" required></textarea>
                                            </div>
                                    </form>
                                </div>
                                @can('edit system setting')
                                    <div class="modal-footer">
                                        <button type="button" id="close_mail_btn" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-info" id="sendTestEmailBtn">Send</button>
                                    </div>
                                @endcan
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

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ url('Admin/js/system-settings/index.js') }}"></script>

    <script>
        const csrfToken = document.getElementById('app').dataset.csrfToken;
        var sendtestemailurl = '{{ route('send-configuration-test-email') }}';
    </script>
@endsection
