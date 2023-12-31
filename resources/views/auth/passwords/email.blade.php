@extends('layouts.auth')
@section('title')
    Forgot Password
@endsection
@php
    $settingsfields = \App\Models\SystemSetting::pluck('value', 'name')->toArray();
@endphp
@section('content')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                @if (isset($settingsfields['logo']))
                    <img src="{{ route('fetchLogo', ['filename' => basename($settingsfields['logo'])]) }}" alt="Logo" style="width:50%;height:100px"
                        alt="Logo">
                @else
                    <img src="{{ url('./assets/image/noLogo.png') }}" alt="Logo" style="width:50%;height:100px">
                @endif
            </div>
            <!-- /.login-logo -->

            <div class="card">
                <div class="card-body login-card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="login-box-msg">Please fill out your email. A link to reset password will be sent to the email
                        you provide.</p>


                    <form method="POST" action="{{ route('password.email') }}">
                        {{-- <form method="POST" action="#"> --}}
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                required autocomplete="email" autofocus placeholder="Email">
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
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn-md btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
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
                    <p class="mb-0">
                        @if (Route::has('register'))
                            <a class="btn btn-link" href="{{ route('register') }}">
                                {{ __('Create new account') }}
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
