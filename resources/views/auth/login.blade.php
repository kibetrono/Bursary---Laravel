@extends('layouts.auth')
@section('title')
    Sign in
@endsection

@section('content')

    <body class="hold-transition login-page">

        <div class="row">
            <div class="col-md-12">

                <div class="login-box">

                    @include('layouts.flash-messages')
                    <!-- /.login-logo -->
                    <div class="card">

                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                                <div class="login-logo">
                                    <img src="{{ asset('assets/image/cdfLogo.png') }}" style="width:50%;height:100px">
                                </div>
                            </div>
                            <div class="card-body login-card-body">

                                <p class="login-box-msg">Sign in to start your session</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="input-group mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Email Address">

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
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password" placeholder="Password">
                                           

                                            <!-- Password visibility toggle -->
                                            <div class="input-group-append">
                                                <span class="input-group-text password-toggle"
                                                    onclick="togglePasswordVisibility()">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-7">
                                            <div class="icheck-primary">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-5">
                                            <button type="submit" class="btn-md btn btn-primary btn-block "> <i class="fa fa-save"></i> Sign
                                                In</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>

                                <div class="social-auth-links text-center mb-3">
                                    <p>- OR -</p>

                                </div>
                                <!-- /.social-auth-links -->

                                <p class="mb-0">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    {{-- <a href="{{ route('password.request') }}" class="text-center">I forgot my password</a> --}}
                                    {{-- <a href="#" class="text-center">I forgot my password</a> --}}
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

                </div>

            </div>
        </div>

    </body>
@endsection
