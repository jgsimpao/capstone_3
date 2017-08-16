<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Ka-Joel's B&amp;B</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('images/home/favicon.png') }}">
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
	<!-- Featherlight -->
	<link rel="stylesheet" type="text/css" href="{{ asset('featherlight/featherlight.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('featherlight/featherlight.gallery.css') }}">
	<!-- Customized Stylesheet -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>

	<header class="container-fluid">
		<div class="jumbotron text-center">
			<div id="brand">
				<div class="brand-roof"></div>
				<h1 class="brand-logo">Ka-Joel's B&amp;B</h1>
				<div class="brand-icon">
					<i class="fa fa-bed" aria-hidden="true"></i>
					<i class="fa fa-plus" aria-hidden="true"></i>
					<i class="fa fa-coffee" aria-hidden="true"></i>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-default navbar-static-top container">
			<div class="navbar-header">

				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->
				<ul class="nav navbar-nav">
					<li id="nav-home" class="nav-link">Home</li>
					{{--<li id="nav-about" class="nav-link">About</li>--}}
					<li id="nav-rooms" class="nav-link">Rooms</li>
					<li id="nav-reserve" class="nav-link">Reserve</li>
					<li id="nav-contact" class="nav-link">Contact</li>
				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
					<!-- Authentication Links -->
					@if(Auth::guest())
						<li id="nav-login" class="nav-link">Login</li>
						<li id="nav-register" class="nav-link">Register</li>
					@else
						<li class="dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->first_name }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ route('logout') }}" 
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										Logout
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</nav>
	</header>

	<input type="hidden" id="csrf" value="{{ csrf_token() }}">
	<main class="container">
		@yield('content')
	</main>

	<footer>
		<div>
			<div class="social-media">
				<a href="https://www.facebook.com/" target="_blank">
					<i class="fa fa-facebook" aria-hidden="true"></i>
				</a>
				<a href="https://www.twitter.com/" target="_blank">
					<i class="fa fa-twitter" aria-hidden="true"></i>
				</a>
				<a href="https://www.instagram.com/" target="_blank">
					<i class="fa fa-instagram" aria-hidden="true"></i>
				</a>
				<a href="https://www.pinterest.com/" target="_blank">
					<i class="fa fa-pinterest" aria-hidden="true"></i>
				</a>
				<a href="https://www.plus.google.com/" target="_blank">
					<i class="fa fa-google-plus" aria-hidden="true"></i>
				</a>
			</div>
		</div>
		<div>
			<p>&copy; 2017 Ka-Joel's B&amp;B. All Rights Reserved.</p>
		</div>
	</footer>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- Featherlight -->
	<script type="text/javascript" src="{{ asset('featherlight/featherlight.js') }}"></script>
	<script type="text/javascript" src="{{ asset('featherlight/featherlight.gallery.js') }}"></script>
	<!-- Customized JavaScript -->
	<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

</body>
</html>
