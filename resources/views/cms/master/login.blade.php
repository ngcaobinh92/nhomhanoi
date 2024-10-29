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
	<section class="body-sign">
		<div class="center-sign">
			<a href="cms" class="logo pull-left">
				<img src="public/octopus/assets/images/logo.png" height="54" alt="Porto Admin" />
			</a>

			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<select onchange="location = this.value;">
						<option hidden>{{ trans('cms.ngon_ngu_hien_thi') }}</option>
		                @php
		                    $website_language = DB::table('language')->where('lang_theme', 1)->orderBy('lang_order', 'DESC')->get();
	                		if(Session::has('website_language')) {
		                		$language_theme = DB::table('language')->where('lang_theme', 1)->where('lang_code', Session::get('website_language'))->first();
		                	}
		                @endphp

	                	@if(Session::has('website_language'))
	                		<option hidden selected value="{!! route('user.change-language', ['language' => $language_theme->lang_code]) !!}"> {{$language_theme->lang_name}}</option>
	                	@endif

                        @foreach ($website_language as $language)
						<option value="{!! route('user.change-language', ['language' => $language->lang_code]) !!}">{{$language->lang_name}}</option>
                        @endforeach
					</select>
					<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> {{ trans('cms.dang_nhap') }} </h2>
				</div>
				<div class="panel-body">
					<form action="" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">

                        @if(session('thongbao'))
						<div class="alert alert-info">
	                        <p class="m-none text-semibold h6">{{session('thongbao')}}</p>
						</div>
                        @endif

						<div class="form-group mb-lg">
							<label>{{ trans('cms.tai_khoan') }}</label>
							<div class="input-group input-group-icon">
								<input name="username" type="email" class="form-control input-lg" placeholder="{{ trans('cms.nhap_tai_khoan') }}..." />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-lg">
							<label>{{ trans('cms.mat_khau') }}</label>
							<div class="input-group input-group-icon">
								<input name="password" type="password" class="form-control input-lg" placeholder="{{ trans('cms.nhap_mat_khau') }}..." />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
							<div class="clearfix">
								<div class="pull-left checkbox-custom checkbox-default">
									<input id="RememberMe" name="rememberme" type="checkbox"/>
									<label for="RememberMe">{{ trans('cms.luu_dang_nhap') }}</label>
								</div>
								<a href="cms/recover" class="pull-right checkbox-custom checkbox-default">{{ trans('cms.quen_mat_khau') }}</a>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-8">
							</div>
							<div class="col-sm-4 text-right">
								<button type="submit" class="btn btn-primary hidden-xs">{{ trans('cms.dang_nhap') }}</button>
								<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">{{ trans('cms.dang_nhap') }}</button>
							</div>
						</div>
					</form>
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