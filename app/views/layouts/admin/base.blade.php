<html lang="en">
  <head>
    @include('layouts/admin/header')
  </head>

  <body>

    <div id="wrapper">
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        @include('layouts/admin/navigation', array('some'=>'data'))
      </nav>

      <div id="page-wrapper">
          @yield('content')
      </div><!-- /#page-wrapper -->
      

    </div><!-- /#wrapper -->

  </body>
</html>
