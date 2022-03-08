@extends('admin.layouts.layout-login')

@section('scripts')
    <script src="/assets/admin/js/sessions/login.js"></script>
    <script>
        initialize();
        function initialize(){
            $('.autocomplete').attr('autocomplete','off');
        }
    </script>
@stop

@section('content')
    @include('auth.partials.login-form')
@stop
