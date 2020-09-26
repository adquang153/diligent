<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cogs"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          @if(auth()->user()->user_type == \App\Models\User::MEMBER)
          <a href="{{route('member.me')}}" class="dropdown-item text-left">
            Profile
          </a>
          @endif
          <a href="javascript:document.querySelector('#logout-form').submit()" class="dropdown-item text-left">
            Logout
            <i class="fas fa-sign-out-alt ml-2"></i>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>