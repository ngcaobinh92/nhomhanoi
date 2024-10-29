<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<meta name="author" content="Bình Nguyễn">
	    <base href="{{asset('')}}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="public/octopus/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="public/octopus/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="public/octopus/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="public/octopus/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="public/octopus/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="public/octopus/assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
			<section class="body-error error-outside">
				<div class="center-error">
					<div class="error-header">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-8">
										<a href="cms" class="logo">
											<img src="public/octopus/assets/images/logo.png" height="54" alt="Porto Admin" />
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="main-error mb-xlg">
								<h2 class="error-code text-dark text-center text-semibold m-none">404 <i class="fa fa-file"></i></h2>
								<p class="error-explanation text-center">{!! trans('lang.404') !!}</p>
								<p class="error-explanation text-center"><a href="cms">{{ trans('lang.return_home') }}</a></p>
							</div>
						</div>
					</div>
				</div>
			</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
		<script src="public/octopus/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="public/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="public/octopus/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="public/octopus/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="public/octopus/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="public/octopus/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="public/octopus/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="public/octopus/assets/javascripts/theme.init.js"></script>

	</body>
</html>