<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
      <!-- <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-normal h4">DG Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset(auth()->user()->avatar ?? 'images/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->full_name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link" data-active="Dashboard">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Dashboard
              </p>
            </a>
          </li>
          @if(auth()->user()->user_type === \App\Models\User::MANAGER)
          <li class="nav-item">
            <a href="" class="nav-link" data-active="zxc">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Cấp tài khoản
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{route('calendar')}}" class="nav-link" data-active="Calendar">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                  Lịch làm việc
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>