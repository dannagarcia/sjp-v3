<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page_title')</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ URL::asset('/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/style.css') }}" rel="stylesheet">

    @section('styles')
     @show
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{URL::to('/')}}" class="site_title"><i class="fa fa-users" aria-hidden="true"></i> <span>San Jose</span></a>
            </div>

            <div class="clearfix"></div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ URL::to('/')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a href="{{ URL::to('/event')}}"><i class="fa fa-calendar"></i> Events</a>
                  </li>
                  <li><a href="{{ URL::to('/alumni')}}"><i class="fa fa-users"></i> Alumni</a>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>  
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <div class="right_col" role="main">
            <div class="row">
                @section('body')
                 @show
            </div>
        </div>

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            San Jose
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{ URL::asset('/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{ URL::asset('/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- morris.js -->
    <script src="{{ URL::asset('/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{ URL::asset('/vendors/morris.js/morris.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{ URL::asset('/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{ URL::asset('/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{ URL::asset('/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ URL::asset('/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ URL::asset('/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ URL::asset('/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{ URL::asset('/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ URL::asset('/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ URL::asset('/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{ URL::asset('/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ URL::asset('/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{ URL::asset('/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('/js/custom.min.js')}}"></script>

    @section('scripts')
     @show
  </body>
</html>