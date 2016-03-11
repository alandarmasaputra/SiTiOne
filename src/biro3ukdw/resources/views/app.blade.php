<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('head_title')</title>

    <!-- core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('style/css/responsive.css') }}" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('style/images/ico/logo1.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('style/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('style/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('style/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('style/images/ico/apple-touch-icon-57-precomposed.png') }}">

    <script src="{{ asset('style/js/jquery.js') }}"></script>
    <script src="{{ asset('style/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('style/js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('style/js/main.js') }}"></script>
    <script src="{{ asset('style/js/wow.min.js') }}"></script>

    @yield('head_addition')
</head><!--/head-->

<body>
     <header id="header">    
        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
            				<div class="search" style="float:right;">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="{{ asset('style/images/logobesar.png') }}" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Home</a></li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">UKM</a></li>
                                <li><a href="">BEASISWA</a></li>
                                <li><a href="">NEWS</a></li>
                                <li><a href="">EVENT</a></li>
                            </ul>
                        </li>
                        <li class="active"><a href="blog.html">Blog</a></li> 
                        <li><a href="contact-us.html">Contact</a></li>       
                        <li><a href=login.html>Login</a></li>                 
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

    @yield('body_content')
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 <a target="_blank">UKDW</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
</body>
</html>