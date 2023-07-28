<!DOCTYPE html>
<html lang="en">
@php
    $settingsfields = \App\Models\SystemSetting::pluck('value', 'name')->toArray();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (isset($settingsfields['favicon']))
        <link rel="icon" href="{{ route('fetchFavicon', ['filename' => basename($settingsfields['favicon'])]) }}">
    @endif
    <title> @yield('title')</title>
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

@yield('content')

<!-- jQuery -->
<script src="{{ url('Admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('Admin/js/adminlte.min.js') }}"></script>
<!-- Custom js -->
<script src="{{ url('Admin/js/auth/auth.js') }}"></script>
</html>
