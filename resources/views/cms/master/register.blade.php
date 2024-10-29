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
		<link rel="stylesheet" href="../public/octopus/assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="../public/octopus/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../public/octopus/assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../public/octopus/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../public/octopus/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../public/octopus/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../public/octopus/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="../public/octopus/assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="cms" class="logo pull-left">
					<img src="../public/octopus/assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
					</div>
					<div class="panel-body">
						<form>
							<div class="form-group mb-lg">
								<label>Name</label>
								<input name="name" type="text" class="form-control input-lg" />
							</div>

							<div class="form-group mb-lg">
								<label>E-mail Address</label>
								<input name="email" type="email" class="form-control input-lg" />
							</div>

							<div class="form-group mb-none">
								<div class="row">
									<div class="col-sm-6 mb-lg">
										<label>Password</label>
										<input name="pwd" type="password" class="form-control input-lg" />
									</div>
									<div class="col-sm-6 mb-lg">
										<label>Password Confirmation</label>
										<input name="pwd_confirm" type="password" class="form-control input-lg" />
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="AgreeTerms" name="agreeterms" type="checkbox"/>
										<label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs">Sign Up</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign Up</button>
								</div>
							</div>

							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>

							<p class="text-center">Already have an account? <a href="pages-signin.html">Sign In!</a>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="../public/octopus/assets/vendor/jquery/jquery.js"></script>
		<script src="../public/octopus/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../public/octopus/assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../public/octopus/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../public/octopus/assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../public/octopus/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../public/octopus/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="../public/octopus/assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../public/octopus/assets/javascripts/theme.init.js"></script>

	</body>
</html>