<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('head_title')</title>

    <!-- core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/css/main.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/css/prettyPhoto.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/css/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('style/css/app.css') }}" rel="stylesheet" type="text/css">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="icon" href="{{ asset('style/images/ico/logo-title.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('style/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('style/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('style/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('style/images/ico/apple-touch-icon-57-precomposed.png') }}">

    <script src="{{ asset('jquery/jquery.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('style/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('style/js/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('style/js/main.js') }}"></script>
    <script src="{{ asset('style/js/wow.min.js') }}"></script>

    @yield('head_addition')
</head><!--/head-->

<body>
     <header id="header">    
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">
					<img class="header-logo" src="{{url('/style/images/ico/logo-white.svg')}}">
					<div class="header-title">
						<div>Biro Kemahasiswaan</div>
						<div>Universitas Kristen Dutawacana</div>
					</div>
				</a>
			</div>
			<div class="collapse navbar-collapse navbar-right">
				<ul class="nav navbar-nav">
					<li><a class="@yield('nav_home')" href="{{ url('/') }}">Home</a></li>
					<li><a class="@yield('nav_beasiswa')" href="{{url('/beasiswa')}}">Beasiswa</a></li> 
					<li><a class="@yield('nav_event')" href="{{url('/event')}}">Event</a></li>    
					<li><a class="@yield('nav_news')" href="{{url('/news')}}">News</a></li>
					<li><a class="@yield('nav_ukm')" href="{{url('/ukm')}}">UKM</a></li>
                    <li><a class="@yield('nav_profil')" href="{{url('/profil')}}">Profil</a></li>
					<li>
						<div class="search">
							<form role="form">
								<input type="text" class="search-form" autocomplete="off" placeholder="Search">
								<i class="glyphicon glyphicon-search"></i><!-- class="fa fa-search" -->
							</form>
						</div>
					</li>
				</ul>
			</div>
		</div>
    </header><!--/header-->
    @include('errors.common')
    @yield('body_content')
    <footer id="footer" class="midnight-blue">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2016 <a target="_blank">UKDW</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
						<li><a href="{{ url('/') }}">Home</a></li>
						<li><a href="{{url('/beasiswa')}}">Beasiswa</a></li> 
						<li><a href="{{url('/event')}}">Event</a></li>    
						<li><a href="{{url('/news')}}">News</a></li>
						<li><a href="{{url('/ukm')}}">UKM</a></li>
						<li><a href="{{url('/profil')}}">Profil</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
</body>
</html>