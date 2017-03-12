<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title or "Yogscast Database" }}</title>
	
	<!--Favicons-->
	<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	<link rel="manifest" href="/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#e74c3c">
	<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#e74c3c">
	
	<!--Bootstrap and Other Vendors-->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/css/magnific-popup.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/vendors/bootstrap-select/css/bootstrap-select.min.css" media="screen">
	
	<!--Fonts-->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	
	<!--Theme Styles-->
	<link rel="stylesheet" href="/css/default/style.css">
	<link rel="stylesheet" href="/css/responsive/responsive.css">
	
	<!--[if lt IE 9]>
	  <script src="/js/html5shiv.min.js"></script>
	  <script src="/js/respond.min.js"></script>
	  <![endif]-->


	  <link rel="stylesheet" href="/css/temp-overrides.css">

	</head>
	<body class="home">

		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand" href="/"><img style='width:100%' src="https://i.imgsir.com/G54X.png" alt=""></a>
				</div>        
				<ul class="nav navbar-nav navbar-right login_drop">
					@if (Auth::check())
					<li class=''>
						<a href='/alerts'><i class='fa fa-bell'></i> Alerts</a>
					</li>
					@else
					<li class=''>
						<a href='/login'><i class='fa fa-bell'></i> Alerts</a>
					</li>
					@endif
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="login_icon"></span> My Account
						</a>
						<ul class="dropdown-menu">
							@if (Auth::check())
							<li><a href="/home">Dashboard</a></li>
							@else
							<li><a href="/login">Login</a></li>
							<li><a href="/register">Sign Up</a></li>
							@endif
						</ul>
					</li>
				</ul>
			</div><!-- /.container-fluid -->
		</nav> <!--Navigation-->

		<section class="row search_filter search_filter_type2">
			<div class="container">
				<div class="row m0">
					<!--Search Form-->
					<div class="btn-group col-md-8 col-md-offset-2">
						<form action="/search" role="search" class="search_form widget widget_search">
							<div class="input-group">
								<input id='header-search' type="text" name='q' class="form-control" placeholder="Search for stuff" >
								<span class="input-group-addon"><button type="submit"><img src="/images/icons/search.png" alt=""></button></span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section> <!--Search Filter-->

		<section class="row post_page_sidebar post_page_sidebar1">
			<div class="container">
				<div class="row">

					@yield('content')

					@include('ydb.sidebar')

				</div>
			</div>
		</section> <!--Uploads-->


		<footer class="row">
			<div class="container">
				<div class="row sidebar sidebar_footer">
					<div class="col-sm-3 widget widget1 w_in_footer widget_about">
						<h5 class="widget_title">About Yogs DB</h5>
						<div class="row m0 inner">
							<p>Yogscast Database is a <strong>fan project</strong> to tag, organize and eventually allow you to alert on Yogscast videos. Ever wanted an alert when a video starring Simon and Sips appears across the network? That's the plan!</p>
						</div>
						<br />
						<h5 class="widget_title">Developers</h5>
						<div class="row m0 inner">
							<p>We're also looking at allowing access to the metadata we create via an API. <a href="mailto:hello@yogsdb.com">Get in touch</a> if you're interested!</p>
						</div>
					</div>
					<div class="col-sm-3 widget widget2 w_in_footer widget_subscribe">
<!-- 						<h5 class="widget_title">subscribe to our newsletter</h5>
						<div class="row m0 inner">
							<form action="#" class="row m0" method="post">
								<input type="email" class="form-control" placeholder="Enter Email Address">
								<input type="submit" value="Submit Now" class="form-control btn btn-default">
							</form>
						</div> -->
					</div>
					<div class="col-sm-3 widget widget2 w_in_footer widget_subscribe">

					</div>
					<div class="col-sm-3 widget widget3 w_in_footer widget_about">
						<h5 class="widget_title">Disclaimer</h5>
						<div class="row m0 inner">
							<p>This is a fan site run by fans of The Yogscast. Video and content copyright along with any and all brands featured on this site belong to Yogscast Ltd or the appropriate channel owner. We make no claim to be associated with or endorsed by The Yogscast or their associates.</p>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<!--jQuery, Bootstrap and other vendor JS-->

		<!--jQuery-->
		<script src="/js/jquery-2.1.4.min.js"></script>

		<!--Bootstrap JS-->
		<script src="/js/bootstrap.min.js"></script>

		<!--jScroll-->
		<script src="/js/jquery.jscroll.min.js"></script>

		<!--Magnific Popup-->
		<script src="/js/jquery.magnific-popup.min.js"></script>

		<!--Bootstrap Select-->
		<script src="/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>

	</body>
	</html>