@extends('layouts.auth')
@section('title')
    Sign up
@endsection

@section('content')

    <body class="hold-transition register-page">
        <div class="row">
            <div class="col-md-12">

                <div class="register-box">

                    @include('layouts.flash-messages')

                    <div class="card">
                        <div class="card card-outline card-primary">
                            <div class="card-header text-center">
                                <div class="login-logo">
                                    <img src="/assets/image/cdfLogo.png" style="width:50%;height:100px">
                                </div>
                            </div>
                            <div class="card-body register-card-body">
                                <p class="login-box-msg">Register a new membership</p>

                                <form action="{{ route('register') }}" method="post">
                                    @csrf

                                    <div class="row">
                                        <div class="input-group mb-3">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                                placeholder="Username">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
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
                                                required autocomplete="new-password" placeholder="Password">
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
                                        <div class="input-group mb-3">
                                            <input id="password-confirm" type="password" name="password_confirmation"
                                                class="form-control" placeholder="Retype password" required>
                                            <!-- Password Confirm visibility toggle -->
                                            <div class="input-group-append">
                                                <span class="input-group-text password-toggle-confirm"
                                                    onclick="togglePasswordConfirmVisibility()">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-8">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                                <label for="agreeTerms">
                                                    I agree to the <a href="#">terms</a>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <button type="submit"
                                                class="btn-md btn btn-primary btn-block">Register</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>

                                <div class="social-auth-links text-center">
                                    <p>- OR -</p>

                                </div>

                                <a href="{{ url('/login') }}" class="text-center">I already have an account</a>
                            </div>
                            <!-- /.form-box -->
                        </div><!-- /.card -->
                    </div>
                    <!-- /.register-box -->


                </div>

            </div>
        </div>

    </body>
@endsection
