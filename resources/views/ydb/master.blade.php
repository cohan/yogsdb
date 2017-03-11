<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Video Cafe | The Best Media Uploader</title>
	
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

  </head>
  <body class="home">

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="/"><img style='width:100%' src="https://i.imgsir.com/G54X.png" alt=""></a>
			</div>        
			<ul class="nav navbar-nav navbar-right login_drop">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="login_icon"></span> My Account
					</a>
					<ul class="dropdown-menu">
						<li><a href="/login">Login</a></li>
						<li><a href="/register">Sign Up</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.container-fluid -->
	</nav> <!--Navigation-->

	<section class="row search_filter search_filter_type2">
		<div class="container">
			<div class="row m0">
				<!--Search Form-->
				<div class="btn-group col-md-9">
					<form action="/" role="search" class="search_form widget widget_search">
						<div class="input-group">
							<input type="text" name='q' class="form-control" placeholder="Search for the stuff" >
							<span class="input-group-addon"><button type="submit"><img src="/images/icons/search.png" alt=""></button></span>
						</div>
					</form>
				</div>
				<!--Category Filter-->
				<div class="btn-group category_filter fright">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="filter-option pull-left">Yogscast Members</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#"><span class="filter_text">All Yogscast</span><span class="badge"></span></a></li>
						<li><a href="#"><span class="filter_text">Simon</span><span class="badge">1208</span></a></li>
						<li><a href="#"><span class="filter_text">Lewis</span><span class="badge">4030</span></a></li>
						<li><a href="#"><span class="filter_text">etc</span><span class="badge">999999</span></a></li>
					</ul>
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
					<h5 class="widget_title">About Video Cafe</h5>
					<div class="row m0 inner">
						<a href="/"><img style='width:100%' src="https://i.imgsir.com/G54X.png" alt=""></a><br>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit</p>
					</div>
				</div>
				<div class="col-sm-3 widget widget2 w_in_footer widget_subscribe">
					<h5 class="widget_title">subscribe to our newsletter</h5>
					<div class="row m0 inner">
						<form action="#" class="row m0" method="post">
							<input type="email" class="form-control" placeholder="Enter Email Address">
							<input type="submit" value="Submit Now" class="form-control btn btn-default">
						</form>
					</div>
				</div>
				<div class="col-sm-3 widget widget3 w_in_footer widget_tags">
					<h5 class="widget_title">popular tags</h5>
					<div class="row m0 inner">
						<a href="#" class="tag">business</a>
						<a href="#" class="tag">osx</a>
						<a href="#" class="tag">windows 10</a>
						<a href="#" class="tag">osx yosemite</a>
						<a href="#" class="tag">photoshop</a>
						<a href="#" class="tag">css</a>
						<a href="#" class="tag">business</a>
						<a href="#" class="tag">osx</a>
						<a href="#" class="tag">windows 10</a>
						<a href="#" class="tag">osx yosemite</a>
						<a href="#" class="tag">photoshop</a>
						<a href="#" class="tag">css</a>
					</div>
				</div>
				<div class="col-sm-3 widget widget4 w_in_footer widget_twitter">
					<h5 class="widget_title">twitter feed</h5>
					<div class="row m0 inner">
						<div class="row m0 tweet"><a href="#">@masum_rana:</a>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat</div>
						<div class="row m0 tweet"><a href="#">@masum_rana:</a>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat</div>
						<div class="row m0 tweet"><a href="#">@masum_rana:</a>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat</div>
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