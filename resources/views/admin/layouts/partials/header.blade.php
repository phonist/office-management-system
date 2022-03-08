<header class="site-header">
  <a href="#" class="brand-main">
    <!-- <img src="{{asset('/assets/admin/img/logo-desk.png')}}" id="logo-desk" alt="Laraspace Logo" class="d-none d-md-inline ">
    <img src="{{asset('/assets/admin/img/logo-mobile.png')}}" id="logo-mobile" alt="Laraspace Logo" class="d-md-none"> -->
  </a>
  <a href="#" class="nav-toggle">
    <div class="hamburger hamburger--htla">
      <span>toggle menu</span>
    </div>
  </a>

  <ul class="action-list">
    <li>
      <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar"><img src="{{ Auth::user()->avatar() }}" alt="Avatar"></a>
      <div class="dropdown-menu dropdown-menu-right notification-dropdown">
        <a class="dropdown-item" href="{{ route('logoutForm.post') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
          <i class="icon-fa icon-fa-sign-out"></i>
          {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logoutForm.post') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</header>