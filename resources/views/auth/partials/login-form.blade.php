<form action="{{ route('login') }}" id="loginForm" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input id="email" type="email" class="form-control autocomplete" name="email" placeholder="Enter email" value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password">
    </div>

    <div class="other-actions row">
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
        </div>
        <div class="col-6 text-right">
            <!-- forgot-password.index (origninal route)-->
            <a href="{{route('password.request')}}" class="forgot-link">Forgot Password?</a>
        </div>
    </div>
    <button class="btn btn-theme btn-full">Login</button>
    <div class="form-group other-options">
        <div class="social-caption pull-left">
            <h6>
                Or Login With
            </h6>
        </div>
        <div class="social-icons pull-right">
            <a href="{{ url('auth\facebook') }}" class="btn btn-default text-primary btn-icon"><i class="icon-fa icon-fa-facebook"></i></a>
            <a href="{{ url('auth\google') }}" class="btn btn-default text-danger btn-icon"><i class="icon-fa icon-fa-google"></i></a>
            <a href="{{ url('auth\github') }}" class="btn btn-default btn-icon text-default"><i class="icon-fa icon-fa-github"></i></a>
        </div>
    </div>
</form>