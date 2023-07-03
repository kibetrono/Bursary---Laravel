<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('Admin/css/adminlte.min.css') }}">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/main.css') }}">
</head>

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
                                  class="form-control @error('password') is-invalid @enderror" name="password" required
                                  autocomplete="current-password" placeholder="Password">
                              <div class="input-group-append">
                                  <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                  </div>
                              </div>

                              @error('password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                          </div>
                          
                              <div class="col-md-8">
                                  <div class="icheck-primary">
                                      <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                          {{ old('remember') ? 'checked' : '' }}>
                                      <label for="remember">
                                          Remember Me
                                      </label>
                                  </div>
                              </div>
                              <!-- /.col -->
                              <div class="col-md-4">
                                  <button type="submit" class="btn-md btn btn-primary btn-block">Sign In</button>
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

        <!-- jQuery -->
        <script src="{{ url('Admin/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->

        <script src="{{ url('Admin/js/adminlte.min.js') }}"></script>

    </div>

  </div>
</div>

</body>

</html>
