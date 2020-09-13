<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Diligent') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/adminlte/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('view.layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('view.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session()->get('success') || session()->get('error'))
    <div class="alert alert-{{session()->get('success') ? 'info' : 'danger'}} alert-global mx-3 mt-2" role="alert">
      <i class="fas fa-check mr-2"></i>
      {{session()->get('success') ?? session()->get('error')}}
      <a href="javascript:document.querySelector('.alert-global').remove()" class="float-right"><i class="fa fa-times" aria-hidden="true"></i></a>
    </div>
    @endif
    
    <div class="content pt-3">
      <!-- Main content -->
      <div class="container-fluid pb-1">
        <div class="title">
          <h3>@yield('title', 'Manager')</h3>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
      </div>
      @yield('content')
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  @include('view.layouts.footer')

</div>
<!-- ./wrapper -->

  @include('view.layouts.scripts')

</body>
</html>
