@extends('layouts.app')

@section('title')
    Update Role
@endsection

@section('css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/dist/css/adminlte.min.css') }}">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/role/style.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Update Role: {{ $role->name }}</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                           
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
                                <h3 class="card-title">Update Role: {{ $role->name }}</h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('role.update', $role->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="role name">Role Name</label>
                                        <input type="text"readonly name='name' id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $role->name }}" placeholder="Role Name" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row px-1">
                                        <div class="col-md-3 mt-2">
                                            <input type="checkbox" id="select-all" name="select_all">
                                            <label style="font-weight:normal" for="select-all">Assign All
                                                Permissions</label>
                                        </div>
                                    </div>

                                    <hr class="py-0 my-0">

                                    {{-- User Permissions --}}
                                    <div class="row pt-2">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-user" class="group-checkbox"
                                                    name="select_all_user">
                                                <label style="font-weight:bold" for="select-all-user"> User
                                                    Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                {{-- Manage User --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage user')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Other User Permissions --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name !== 'manage user' && strpos($permission->name, 'user') !== false)
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /User Permissions --}}


                                    {{-- Staff Permissions --}}
                                    <div class="row">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-staff" class="group-checkbox"
                                                    name="select_all_staff">
                                                <label style="font-weight:bold" for="select-all-staff"> Staff
                                                    Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                {{-- Manage Staff --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage staff')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Other Staff Permissions --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name !== 'manage staff' && strpos($permission->name, 'staff') !== false)
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Staff Permissions --}}


                                    {{-- Role Permissions --}}
                                    <div class="row">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-role" class="group-checkbox"
                                                    name="select_all_role">
                                                <label style="font-weight:bold" for="select-all-role">Role
                                                    Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                {{-- Manage Role --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage role')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Other Role Permissions --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name !== 'manage role' && strpos($permission->name, 'role') !== false)
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Role Permissions --}}


                                    {{-- Permission Permissions --}}
                                    {{-- <div class="row">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-permission" class="group-checkbox"
                                                    name="select_all_permission">
                                                <label style="font-weight:bold" for="select-all-permission">Permission
                                                    Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage permission')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name !== 'manage permission' && strpos($permission->name, 'permission') !== false)
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- Permission Permissions --}}


                                    {{-- Application Period Permissions --}}
                                    <div class="row">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-application-period"
                                                    class="group-checkbox" name="select_all_application_period">
                                                <label style="font-weight:bold"
                                                    for="select-all-application-period">Application Period
                                                    Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage application period')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name !== 'manage application period' && strpos($permission->name, 'application period') !== false)
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /Application Period Permissions --}}


                                    {{-- Bursary Permissions --}}
                                    <div class="row">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-bursary" class="group-checkbox"
                                                    name="select_all_bursary">
                                                <label style="font-weight:bold" for="select-all-bursary">Bursary
                                                    Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                {{-- Display the permission with "manage" first --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage bursary')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Display other bursary permissions --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if (strpos($permission->name, 'bursary') !== false && $permission->name !== 'manage bursary')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /Bursary Permissions --}}


                                    {{-- System Permissions --}}
                                    <div class="row">
                                        <div class="col-md-12 permissions-group">
                                            <div class="px-1">
                                                <input type="checkbox" id="select-all-system-setting"
                                                    class="group-checkbox" name="select_all_system_setting">
                                                <label style="font-weight:bold" for="select-all-system-setting">System
                                                    Settings Permissions</label>
                                            </div>
                                            <div class="permissions-row">
                                                {{-- Display the permission with "manage" first --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if ($permission->name === 'manage system setting')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                {{-- Display other system setting permissions --}}
                                                @foreach ($permissions as $index => $permission)
                                                    @if (strpos($permission->name, 'system setting') !== false && $permission->name !== 'manage system setting')
                                                        <div class="permission-item">
                                                            <input type="checkbox" id="{{ $permission->name }}"
                                                                name="permissions[]" value="{{ $permission->id }}"
                                                                {{ $role->permissions->pluck('id')->contains($permission->id) ? 'checked' : '' }}>
                                                            <label style="font-weight:normal"
                                                                for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /System Permissions --}}


                                    <!-- Add more sections for other groups as needed -->

                                    <div class="px-1">
                                        <button type="submit" class="btn-md btn btn-success"><i class="fas fa-save"></i>
                                            Update Role</button>
                                    </div>

                                </div>

                                <!-- /.card-body -->
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
    <script src="{{ url('Admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ url('Admin/js/role/app.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ url('Admin/dist/js/adminlte.min.js') }}"></script>
@endsection
