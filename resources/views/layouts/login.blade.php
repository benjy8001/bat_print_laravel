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

	<title>Gestion de Stock Roto</title>

	<link type="text/plain" rel="author" href="humans.txt" />

	<!-- Favicons-->
	<link rel="icon" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}" sizes="32x32">
	<!-- Favicons-->
	<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/images/favicon/apple-touch-icon-152x152.png') }}">
	<!-- For iPhone -->
	<meta name="msapplication-TileColor" content="#00bcd4">
	<meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon/mstile-144x144.png') }}">
	<!-- For Windows Phone -->

	<!-- CORE CSS-->

	<link href="{{ asset('assets/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="{{ asset('assets/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
	<!-- Custome CSS-->
	<link href="{{ asset('assets/css/custom/custom.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="{{ asset('assets/css/layouts/page-center.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

	<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
	<link href="{{ asset('assets/js/plugins/prism/prism.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">

	<noscript>Your browser does not support JavaScript!</noscript>

</head>
<body class="black">

	<img id="bg" class="img-fond flip" alt="bg" src="{{ asset('assets/images/stock-imprimerie.jpg') }}">

	<!-- Start Page Loading -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<!-- End Page Loading -->

		   <!--[if lt IE 10]>
			<div style="width:400px;margin:auto;margin-top:50px;text-align:center;font-size:12px;background:#D6E8FE;padding:10px;font-weight:bold">
				<p class="chromeframe">
					Vous utilisez actuellement un navigateur <strong>obsolete</strong>. <br />
					Il est vivement recommandé de <a href="http://browsehappy.com/">mettre à jour votre navigateur</a>
					ou d'<a href="http://www.google.com/chromeframe/?redirect=true">activer Google Chrome Frame</a>
					pour améliorer votre expérience.
				</p>
			</div>
			<![endif]-->
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

			@yield('content')

			<!-- JavaScripts -->
<!--[if lt IE 9]>
	<script type="text/javascript">
		document.write('<script src="{{ asset('assets/js/plugins/jquery/jquery-1.11.2.min.js') }}"><\/script>');
	</script>
	<![endif]-->
	<script type="text/javascript">
		document.write('<script src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/materialize.js') }}" type="text/javascript"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/prism/prism.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"><\/script>');
		//plugins.js - Some Specific JS codes for Plugin Settings
		document.write('<script src="{{ asset('assets/js/plugins.js') }}"><\/script>');
		//custom-script.js - Add your own theme custom JS
		document.write('<script src="{{ asset('assets/js/custom-script.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/plugins/jquery-validation/localization/messages_fr.min.js') }}"><\/script>');
		document.write('<script src="{{ asset('assets/js/index.js') }}"><\/script>');
	</script>
</body>
</html>
