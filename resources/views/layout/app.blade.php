<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/assets/css/colors.css') }}" rel="stylesheet" type="text/css">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('theme/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
@stack('headerscript')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('theme/assets/js/core/app.js') }}"></script>
    <!-- /theme JS files -->
</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('payment.index') }}"><img src="{{ asset('theme/assets/images/logo_light.png') }}" alt=""></a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('theme/assets/images/demo/users/face11.jpg') }}" alt="">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="caret"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                            <li><a href="#" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">
                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            <ul class="navigation navigation-main navigation-accordion">
                                <!-- Main -->
                                <li class="navigation-header"><span>Start</span> <i class="icon-menu" title="Main pages"></i></li>



				<li><a href='/howitworks'><i class="icon-user"></i> <span>Home</span></a></li>



                                     <li><a href="{{ route('payment.index') }}"><i class="icon-paypal2"></i> <span>Payment Management</span></a></li>
                               
                                        <li><a href='{{ route("payment.search") }}'><i class="icon-folder-search"></i> <span>Search Payment</span></a></li>
                                         @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
										<li><a href="{{ route('offpayment.payrecord') }}"><i class="icon-paypal2"></i> <span>Off cycle Payment Management</span></a></li>
                               
                                        <li><a href='{{ route("offpayment.search") }}'><i class="icon-folder-search"></i> <span>Search Off cycle Payment</span></a></li>
@endif


										@if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
				<li class="">
                                                    <a href="#" class="has-ul"><i class="icon-user-plus"></i> <span>User Management</span></a>
                                                    <ul class="hidden-ul" style="display: none;">

                                                        <li><a href="{{ route('users.index') }}">All Users</a></li>
                                                         <li><a href="{{ route('users.create') }}">Create Users</a></li>
                                                    </ul>
                                                </li>
                                @endif

								<li><a href="{{ url('home') }}"><i class="icon-megaphone"></i> <span>Send Message</span></a></li>

                               @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
                               <li class="">
                                    <a href="#" class="has-ul"><i class="icon-database"></i> <span>Master Data</span></a>
                                    <ul class="hidden-ul" style="display: none;">
                                        <li><a href="{{ route('statemaster.index') }}">States</a></li>
                                        <li><a href="{{ route('lgamaster.index') }}">LGA</a></li>
                                        <li><a href="{{ route('wardmaster.index') }}">Ward</a></li>
                                        <li><a href="{{ route('categorymaster.index') }}">Category</a></li>
                                        <li><a href="{{ route('gsmmaster.index') }}">GSM</a></li>
                                    </ul>
                                </li>

                                @endif

                                 <li class="">
                                <a href="#" class="has-ul"><i class="icon-user"></i> <span>Reports</span></a>
                                <ul class="hidden-ul" style="display: none;">


                                  @if(\Illuminate\Support\Facades\Auth::user()->isadmin==0)
                                 <li> <a href="{{ route('reports.weekly.create') }}"> <i class="icon-user"></i> Create Report </a> </li>
                                  @endif

                                 <li> <a href="{{ route('reports.weekly.view') }}"> <i class="icon-user"></i> View Reports </a> </li>

                               </ul>
                                </li>
                            @if(\Illuminate\Support\Facades\Auth::user()->isadmin==1)
                             <li><a href="{{ route('payment.history') }}"><i class="icon-paypal2"></i> <span>Payment History</span></a></li>
                            @endif

                            </ul>
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->

           @section('content')

           @show

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
 @stack('footerscript')
</body>
</html>
