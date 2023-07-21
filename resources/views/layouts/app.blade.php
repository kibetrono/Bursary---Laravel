<!DOCTYPE html>
<html lang="en">
@php
$settingsfields = \App\Models\SystemSetting::pluck('value', 'name')->toArray();
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="icon" href="{{ url('./assets/image/cdfLogo.png') }}" type="image/x-icon"> --}}

    @if (isset($settingsfields['favicon']))
    <link rel="icon" href="{{ asset('storage/' . $settingsfields['favicon']) }}">
    @endif
    
    <title>@yield('title')</title>

    @yield('css')

    {{-- custom header css --}}
    <link rel="stylesheet" href="{{ url('Admin/css/header.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('layouts.header')

        @include('layouts.sidebar')

        @yield('content')

        @include('layouts.footer')

    </div>
    <!-- ./wrapper -->

    @yield('js')

</body>

</html>
