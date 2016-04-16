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
	<div>
	</div>
     <header id="header">    
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/')}}">
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
		<div id="header-login" class="container-fluid header-login collapse">
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					@if(!Auth::user())
					<li>
						<a href="{{url('/login')}}">Login</a>
					</li>
					@else
					<li>
						<span><em>{{Auth::user()->authlevelstring()}}</em></span>
					</li>
					<li>
						<span><strong><a href="{{url('/editprofile')}}">{{Auth::user()->username}}</a></strong></span>
					</li>
					<li>
						<a href="{{url('/logout')}}">Logout</a>
					</li>
					@endif
				</ul>
			</div>
		</div>
		<div class="header-login-button container-fluid text-right">
			<button type="button" data-toggle="collapse" data-target=".header-login">
				<span class="glyphicon glyphicon-menu-down"></span>
			</button>
		</div>
    </header><!--/header-->
	<script>
	$('.header-login-button button').click(function(){
		if($('.header-login-button button span').hasClass('glyphicon-menu-down')){
			$('.header-login-button button span').removeClass('glyphicon-menu-down');
			$('.header-login-button button span').addClass('glyphicon-menu-up');
		}
		else{
			$('.header-login-button button span').removeClass('glyphicon-menu-up');
			$('.header-login-button button span').addClass('glyphicon-menu-down');
		}
	})
	</script>
    @include('errors.common')
    @yield('body_content')
    <footer id="footer" class="midnight-blue">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
					 <p class="glyphicon glyphicon-map-marker"> Jl.Dr.Wahidin Sudiro Husodo No.5–25, Yogyakarta (55224)</p>
					<p class="glyphicon glyphicon-earphone"> Telp.0274–563929 Fax.0274–513235   </p>
					<p class="glyphicon glyphicon-envelope"> Email: humas@staff.ukdw.ac.id</p>
                </div>
                <div class="col-sm-8">
                    <div class="pull-right">
						&copy; 2016 <a target="_blank">UKDW</a>. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
</body>
</html>