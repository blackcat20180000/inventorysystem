<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('admin.header')
        <style>
             .invalid-feedback
            {
                display:block!important;
            }
        </style>
    
    </head>
<body class="app sidebar-mini rtl">
     @include('admin.navbar')
     <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
     @include('admin.sidebar')
     <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
        @yield('content')
    </main>
</body>
    @include('admin.footer')
</html>