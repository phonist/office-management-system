<!DOCTYPE html>
<html>
<head>
    <title>Buzzer Office</title>
    <link href="{{ asset('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.favicons')
</head>
<body class="login-page login-1">
<div id="app" class="login-wrapper">
    <div class="login-box">
        @include('admin.layouts.partials.laraspace-notifs')
        <div class="logo-main">
            Office Management System
        </div>
        <!-- <div class="logo-main">
            <a href="/"><img src="/assets/admin/img/logo-large.png" alt="Laraspace Logo"></a>
        </div> -->
        @yield('content')
        <div class="page-copyright">
            <p>Powered by <a href="#" target="_blank">Phonist</a></p>
            <p>Phonist © {{ date('Y') }}</p>
        </div>
    </div>
</div>
<script src="{{asset('/assets/admin/js/core/plugins.js')}}"></script>
<script src="{{asset('/assets/admin/js/core/app.js')}}"></script>
@yield('scripts')
</body>
</html>
