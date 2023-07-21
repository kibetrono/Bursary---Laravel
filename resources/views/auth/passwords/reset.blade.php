@extends('layouts.auth')
@section('title')
    Recover Password
@endsection
@php
    $settingsfields = \App\Models\SystemSetting::pluck('value', 'name')->toArray();
@endphp
@section('content')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                @if (isset($settingsfields['logo']))
                    <img src="{{ asset('storage/' . $settingsfields['logo']) }}" alt="Logo" style="width:50%;height:100px"
                        alt="Logo">
                @else
                    <img src="{{ url('./assets/image/noLogo.png') }}" alt="Logo" style="width:50%;height:100px">
                @endif

            </div>
            <!-- /.login-logo -->
            <div class="row">
                <div class="col-sm-12">
                    @include('layouts.flash-messages')
                </div>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Please fill out the email, password and confirm password fields to recover your
                        account.</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group mb-3">
                            {{-- <input type="email" class="form-control" placeholder="Email address"> --}}
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                placeholder="Email address" autofocus>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password" placeholder="Password">

                            <!-- Password visibility toggle -->
                            <div class="input-group-append">
                                <span class="input-group-text password-toggle" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password" placeholder="Confirm Password">

                            <!-- Password Confirm visibility toggle -->
                            <div class="input-group-append">
                                <span class="input-group-text password-toggle-confirm"
                                    onclick="togglePasswordConfirmVisibility()">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn-md btn btn-primary btn-block">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        @if (Route::has('login'))
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        @endif
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

    </body>
@endsection
