<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
      <!-- <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-normal h4">Trang Quản Lý</span>
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
          <a href="javascript:void(0)" class="font-14 text-white online">{{optional(auth()->user()->contract)->role ?? auth()->user()->user_type}}</a>
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
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link" data-active="">
              <i class="nav-icon fas fa-users"></i>
              <p>
                  Quản lý nhân viên
                  <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('member.create')}}" class="nav-link" data-active="member/create">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cấp tài khoản</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('member.index')}}" class="nav-link" data-active="member/index">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách nhân viên</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{route('calendar')}}" class="nav-link" data-active="Calendar">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                  Lịch làm việc
              </p>
            </a>
          </li>
          @if(auth()->user()->user_type == \App\Models\User::MEMBER)
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Đơn nghỉ phép
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('leave-form.create')}}" class="nav-link" data-active="leave-form/create">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Viết đơn</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('leave-form.wait')}}" class="nav-link" data-active="leave-form/wait">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đơn đã gửi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Yêu cầu ứng lương
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('salary.create')}}" class="nav-link" data-active="salary/create">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gửi yêu cầu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('salary.advance')}}" class="nav-link" data-active="salary/advance">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Đã gửi</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(auth()->user()->user_type == \App\Models\User::MANAGER)
          <li class="nav-item">
            <a href="{{route('leave-form.wait')}}" class="nav-link" data-active="leave-form/wait">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Danh sách nghỉ phép
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('salary.advance')}}" class="nav-link" data-active="salary/advance">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Danh sách ứng lương
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <!-- <i class="nav-icon fas fa-money-check-alt"></i> -->
              <i class="nav-icon fab fa-delicious"></i>
              <p>
                Quản lý chuyên cần
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('work.index')}}" class="nav-link" data-active="works">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thống kê</p>
                </a>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>