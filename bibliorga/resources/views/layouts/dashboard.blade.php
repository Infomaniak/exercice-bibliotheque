<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 18/12/2018
 * Time: 14:09
 */
?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<base href="/">--}}
    <title>{{ config('app.name') }} | {{$title}}</title>

    <!-- Styles -->
    {{Html::style(mix('css/semantic.css'))}}
    <!-- Bootstrap -->
    <link href="https://colorlib.com/polygon/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://colorlib.com/polygon/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    {{--<link href="https://colorlib.com/polygon/vendors/nprogress/nprogress.css" rel="stylesheet">--}}
<!-- iCheck -->
    <link href="https://colorlib.com/polygon/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    {{--<link href="https://colorlib.com/polygon/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css"--}}
    {{--rel="stylesheet">--}}
<!-- JQVMap -->
    {{--<link href="https://colorlib.com/polygon/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>--}}
<!-- bootstrap-daterangepicker -->
    {{--<link href="https://colorlib.com/polygon/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">--}}

<!-- Custom Theme Style -->
    <link href="https://colorlib.com/polygon/build/css/custom.min.css" rel="stylesheet">
    {{Html::style(mix('css/dashboard.css'))}}
    <style>
    .idLogo {
    display: inline-block;
    width: 150px;
}
    </style>
    @yield('styles')
</head>
<body class="nav-md" ng-app="myApp">

@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible position-absolute fade show" role="alert"
         style="z-index: 1; top: 10vh; right: 1px">
        <strong>Succès!</strong> {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(!empty($errors->first()))
    @for($i=0; $i<$errors->count(); $i++)
        <div class="alert alert-danger alert-dismissible position-absolute fade show" role="alert"
             style="z-index: 1; top: {{10*0.5*$i+1}}vh; right: 1px">
            <strong>Erreur!</strong> {{$errors->first()}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endfor
@endif

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a target="_parent" href="{{url('/')}}" class="site_title"><img class="idLogo" src="http://80.211.56.41:8006/images/full_Bibliorga_white_text_white.png" alt="Logo Bibliorga">
                        <span>Bibliorga</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{auth()->user()->profile_image}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>{{__('Bienvenu')}},</span>
                        <h2>{{auth()->user()->firstname}} {{auth()->user()->lastname}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-home"></i> {{__('Accueil')}} <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="/dashboard">Dashboard</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Gérer <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{route('author.index')}}">Auteurs</a></li>
                                    <li><a href="{{route('book.index')}}">Livres</a></li>
                                    <li><a href="{{route('borrowing.index')}}">Emprunts</a></li>
                                    @if(auth()->user()->isAdmin())
                                        <li><a href="{{route('user.index')}}">Utilisateurs</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="menu_section">
                        <h3>Live On</h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-bug"></i> Additional Pages <span
                                        class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="projects.html">Projects</a></li>
                                    <li><a href="project_detail.html">Project Detail</a></li>
                                    <li><a href="contacts.html">Contacts</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="page_403.html">403 Error</a></li>
                                    <li><a href="page_404.html">404 Error</a></li>
                                    <li><a href="page_500.html">500 Error</a></li>
                                    <li><a href="plain_page.html">Plain Page</a></li>
                                    <li><a href="login.html">Login Page</a></li>
                                    <li><a href="pricing_tables.html">Pricing Tables</a></li>
                                </ul>
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

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="{{auth()->user()->profile_image}}"
                                     alt="">{{auth()->user()->firstname}} {{auth()->user()->lastname}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="{{route('home')}}"> Profile</a></li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">Help</a></li>
                                <li>
                                    <a href="{{route('logout')}}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> {{__('Se déconnecter')}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->
    </div>
</div>

@include('layouts.partials.footer')
<!-- Scripts -->
<!-- jQuery -->
<script src="https://colorlib.com/polygon/vendors/jquery/dist/jquery.min.js"></script>
{{Html::script(mix('js/semantic.js'))}}
<!-- Bootstrap -->
<script src="https://colorlib.com/polygon/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
{{--<script src="https://colorlib.com/polygon/vendors/fastclick/lib/fastclick.js"></script>--}}
<!-- NProgress -->
{{--<script src="https://colorlib.com/polygon/vendors/nprogress/nprogress.js"></script>--}}
<!-- Chart.js -->
<script src="https://colorlib.com/polygon/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
{{--<script src="https://colorlib.com/polygon/vendors/gauge.js/dist/gauge.min.js"></script>--}}
<!-- bootstrap-progressbar -->
<script src="https://colorlib.com/polygon/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="https://colorlib.com/polygon/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
{{--<script src="https://colorlib.com/polygon/vendors/skycons/skycons.js"></script>--}}
<!-- Flot -->
<script src="https://colorlib.com/polygon/vendors/Flot/jquery.flot.js"></script>
{{--<script src="https://colorlib.com/polygon/vendors/Flot/jquery.flot.pie.js"></script>--}}
<script src="https://colorlib.com/polygon/vendors/Flot/jquery.flot.time.js"></script>
{{--<script src="https://colorlib.com/polygon/vendors/Flot/jquery.flot.stack.js"></script>--}}
<script src="https://colorlib.com/polygon/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
{{--<script src="https://colorlib.com/polygon/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>--}}
<script src="https://colorlib.com/polygon/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
{{--<script src="https://colorlib.com/polygon/vendors/flot.curvedlines/curvedLines.js"></script>--}}
<!-- DateJS nav responsive-->
<script src="https://colorlib.com/polygon/vendors/DateJS/build/date.js"></script>
{{--<!-- JQVMap -->--}}
{{--<script src="https://colorlib.com/polygon/vendors/jqvmap/dist/jquery.vmap.js"></script>--}}
{{--<script src="https://colorlib.com/polygon/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>--}}
{{--<script src="https://colorlib.com/polygon/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>--}}
{{--<!-- bootstrap-daterangepicker -->--}}
{{--<script src="https://colorlib.com/polygon/vendors/moment/min/moment.min.js"></script>--}}
{{--<script src="https://colorlib.com/polygon/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>--}}

<!-- Custom Theme Scripts -->
<script src="https://colorlib.com/polygon/build/js/custom.min.js" defer></script>
<script src="{{mix('js/angular.js')}}"></script>
<script>
    window.onload = function () {
        $(".alert").delay(4000).slideUp(200, function () {
            $(this).alert('close');
        });
    }
</script>
@yield('scripts')
</body>
</html>
