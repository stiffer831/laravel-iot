<ul class="navbar-nav ml-auto">
  <li class="nav-item">
    <a class="nav-link" data-widget="fullscreen" href="javascript:;" role="button">
      <i class="fas fa-expand-arrows-alt"></i>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="avatar fas fa-user"></i>
      <span>
        {{ customer_info()['auth_user']['fullName'] ?: customer_info()['auth_user']['name'] }}
        ( {{ customer_info()['authority']['title'] ?? '' }} )
      </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <a href="{{ route('customer.profile') }}" class="dropdown-item">
        <i class="fas fa-user mr-2"></i>
        {{ __('customer.profile') }}
      </a>
      <div class="dropdown-divider"></div>
      <a href="{{ route('logout') }}" class="dropdown-item">
        <i class="fas fa-arrow-alt-circle-right mr-2"></i>
        {{ __('customer.logout') }}
      </a>
    </div>
  </li>
</ul>