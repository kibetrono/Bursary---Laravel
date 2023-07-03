<h1>Welcome to our system!</h1>

<p>Your account has been created successfully. You can now log in using your email address and password.</p>

<p>Your email address: {{ $user->email }}</p>

<p>Your password: {{ $user->password }}</p>

<p>Please click the button below to log in.</p>

<a href="{{ route('login') }}" class="btn btn-primary">Log in</a>