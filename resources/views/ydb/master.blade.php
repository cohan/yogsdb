<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $title or "Yogscast Database" }}</title>
	<?php

	/*

	@if (!empty($pageType) && $pageType == "video")
	<!--
		Hey view-source-r! If you're wondering what this canonical link is about
		it links back to the YouTube video on this page.

		That way this site doesn't steal any SEO juice from the original video
		and as a bonus passes along any extra this page earns. Woohoo!
	-->
	<link rel="canonical" href="https://www.youtube.com/watch?v={{ $video->youtube_id }}">
	@else
	<link rel="canonical" href="{{ Request::url() }}">		
	@endif

	*/

	?>	
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
	
	<!--Fonts-->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	
	<!--Theme Styles-->
	<link rel="stylesheet" href="/css/default/style.css">
	<link rel="stylesheet" href="/css/responsive/responsive.css">
	
	<!--[if lt IE 9]>
	  <script src="/js/html5shiv.min.js"></script>
	  <script src="/js/respond.min.js"></script>
	  <![endif]
	-->


	<!--jQuery, Bootstrap and other vendor JS-->

	<!--jQuery-->
	<script src="/js/jquery-2.1.4.min.js"></script>

	<!--Bootstrap JS-->
	<script src="/js/bootstrap.min.js"></script>

	<!--Magnific Popup-->
	<script src="/js/jquery.magnific-popup.min.js"></script>

	<!--Bootstrap Select-->
	<script src="/js/chosen.jquery.js"></script>

	<link rel="stylesheet" href="/css/chosen.css">

	<link rel="stylesheet" href="/css/temp-overrides.css">

</head>
<body class="home">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-80857446-2', 'auto');
		ga('send', 'pageview');

	</script>


	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="https://yogsdb.com/"><img style='width:100%' src="https://i.imgsir.com/G54X.png" alt=""></a>
			</div>        
			<ul class="nav navbar-nav navbar-right login_drop">
				<li class=''>
					<a href='/onthisday'><i class='fa fa-clock-o'></i> On This Day</a>
				</li>	

				<?php
				/*
				@if (Auth::check())
				<li class=''>
					<a href='/alerts'><i class='fa fa-bell'></i> Alerts</a>
				</li>
				@else
				<li class=''>
					<a href='/login'><i class='fa fa-bell'></i> Alerts</a>
				</li>
				@endif
				*/
				?>
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
							<input id='header-search' type="text" name='q' class="form-control" placeholder="Search for stuff" 
							@if (Request::get('q'))
							value="{{ Request::get('q') }}"
							@endif
							>
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
				</div>
				<div class="col-sm-3 widget widget2 w_in_footer widget_about">
					<h5 class="widget_title">Developers</h5>
					<div class="row m0 inner">
						<p>We're also looking at allowing access to the series, stars, tags, etc metadata we create via an API. Get in touch if you're interested!</p>
					</div>
				</div>
				<div class="col-sm-3 widget widget2 w_in_footer widget_about">
					<h5 class="widget_title">Contact</h5>
					<div class='row m0 inner'>
						<p>
							Fancy a natter? <a href="https://cohanrobinson.com/contact/" target="_blank">get in touch!</a>
						</p>
						<p>
							Side note you might know me as corobo on the reddits and/or coorbo in the Twitch stream chat
						</p>
					</div>
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
</body>
</html>