	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="robots" content="index,follow,all">
		<meta name="robots" content="INDEX|FOLLOW">
		<meta name="keywords" content=""/>
		<meta name="description" content="" />
		<meta name="Author" content="Plug-it">

		<title>Gestion de stock Rotocentre</title>

		<link type="text/plain" rel="author" href="humans.txt" />

		<!-- Favicons-->
		<link rel="icon" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" sizes="32x32">
		<!-- Favicons-->
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}">
		<!-- For iPhone -->
		<meta name="msapplication-TileColor" content="#00bcd4">
		<meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/mstile-144x144.png') }}">
		<!-- For Windows Phone -->

		<meta name="csrf-token" content="{{ csrf_token() }}" id="token">

		<!-- CORE CSS-->

		<link href="{{ asset('assets/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="{{ asset('assets/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
		<!-- Custome CSS-->
		<link href="{{ asset('assets/css/custom/custom.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

		<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
		<link href="{{ asset('assets/js/plugins/prism/prism.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="{{ asset('assets/js/plugins/chartist-js/chartist.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="{{ asset('assets/js/plugins/sweetalert/dist/sweetalert.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="{{ asset('assets/js/plugins/sweetalert/themes/google/google.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

		<link href="{{ asset('assets/css/plugit.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

		@yield('custom_css')

		<noscript>Your browser does not support JavaScript!</noscript>
	</head>


	<body class="white">
		<!-- Start Page Loading -->
		<div id="loader-wrapper">
			<div id="loader"></div>
			<div class="loader-section section-left"></div>
			<div class="loader-section section-right"></div>
		</div>
		<!-- End Page Loading -->

		@include('layouts.includes_app.headBar')
		<!-- START MAIN -->
		<div id="main">
			<!-- START WRAPPER -->
			<div class="wrapper">
				<!--[if lt IE 10]>
				<div style="width:400px;margin:auto;margin-top:5px;text-align:center;font-size:12px;background:#D6E8FE;padding:10px;font-weight:bold">
					<p class="chromeframe">
						Vous utilisez actuellement un navigateur <strong>obsolete</strong>. <br />
						Il est vivement recommandé de <a href="http://browsehappy.com/">mettre à jour votre navigateur</a>
						ou d'<a href="http://www.google.com/chromeframe/?redirect=true">activer Google Chrome Frame</a>
						pour améliorer votre expérience.
					</p>
				</div>
				<![endif]-->

				@include('layouts.includes_app.sidebar_menu')

				<!-- START CONTENT -->
				<section id="content">

					@yield('breadcrumbs')

					<!--start container-->
					<div class="container">
						<div class="section">
							@if(Session::has('success'))
							<div id="card-alert" class="card green">
								<div class="card-content white-text">
									<p><i class="mdi-navigation-check"></i> {{ Session::get('success') }}</p>
								</div>
								<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							@endif

							@if(Session::has('error'))
							<div id="card-alert" class="card orange">
								<div class="card-content white-text">
									<p><i class="mdi-alert-warning"></i> {{ Session::get('error') }}</p>
								</div>
								<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							@endif

							@if (count($errors) > 0)
							<div id="card-alert" class="card orange">
								<div class="card-content white-text">
									<p>
										@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</p>
								</div>
								<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							@endif

							@yield('content')
						</div>
					</div>
				</section>

				<!--
				@if (Auth::guest())
				<li><a href="{{ url('/login') }}">Login</a></li>
				<li><a href="{{ url('/register') }}">Register</a></li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						{{ Auth::user()->name }} <span class="caret"></span>
					</a>

					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
					</ul>
				</li>
				@endif
			-->

		</div><!-- ./wrapper -->
	</div><!-- ./main -->

	<!-- START FOOTER -->
	<footer class="page-footer">
		<div class="footer-copyright">
			<div class="container">
				<span>Copyright © 2017 <a class="grey-text text-lighten-4" href="https://www.plug-it.com" target="_blank">Plug-It</a> All rights reserved.</span>
			</div>
		</div>
	</footer>
	<!-- END FOOTER -->

	<!--[if lt IE 9]>
	<script type="text/javascript">
		document.write('<script src="assets/js/plugins/jquery/jquery-1.11.2.min.js"><\/script>');
	</script>
	<![endif]-->
	<script type="text/javascript">
		document.write('<script src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/materialize.js') }}" type="text/javascript"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/prism/prism.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/sweetalert/dist/sweetalert.min.js') }}"><\/script>');
	//plugins.js - Some Specific JS codes for Plugin Settings
	document.write('<script src="{{ asset('assets/js/plugins.js') }}"><\/script>');
	//custom-script.js - Add your own theme custom JS
	document.write('<script src="{{ asset('assets/js/custom-script.js') }}"><\/script>');
	document.write('<script src="{{ asset('assets/js/main.js') }}"><\/script>');

	@yield('custom_js')
</script>

</body>
</html>




