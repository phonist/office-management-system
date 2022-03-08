
<header class="site-header">
  <a href="#" class="brand-main">
    <img src="{{asset('/assets/admin/img/logo-desk.png')}}" id="logo-desk" alt="App Logo" class="hidden-sm-down">
  </a>

  <ul class="action-list">
    <li>
      <a href="/admin">Admin Dashboard</a>
    </li>
    @if(Auth::check())
      <li>
        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar">
          
          @if(Auth::user()->photo != NULL)
          <img src="/employeesPhoto/{{ Auth::user()->photo }}" alt="{{ Auth::user()->photo }}"></a>
          @else
          <img src="{{asset('/assets/admin/img/avatars/user.png')}}" alt="Avatar"></a>
          @endif
          <div class="dropdown-menu dropdown-menu-right notification-dropdown">
            <a class="dropdown-item" href="/logout"><i class="icon-fa icon-fa-sign-out"></i> Logout</a>
          </div>
      </li>
    @endif
  </ul>
</header>