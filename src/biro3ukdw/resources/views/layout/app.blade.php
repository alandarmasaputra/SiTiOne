<!DOCTYPE html>
<html>
    <head>
        <title>@yield('head_title')</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
		<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('exambro/css/exambro.css')}}" rel="stylesheet" type="text/css">
		<script src="{{ asset('jquery/jquery.js')}}" type="text/javascript"></script>
		<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		@yield('head_addition')
    </head>
    <body>
		<nav class="navbar navbar-default" >
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				  	</button>
				  <a class="navbar-brand" href="{{ url('/') }}">Title</a>
				</div>
    			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="#">Item1</a></li>
						<li><a href="#">Item2</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@if(Auth::check())
                            <li><a href="#"><strong>{{Auth::user()->name}}</strong></a></li>
                            <li><a href="{{url('/logout')}}">Logout</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		@include('errors.common')
		@yield('body_content')
    </body>
</html>
