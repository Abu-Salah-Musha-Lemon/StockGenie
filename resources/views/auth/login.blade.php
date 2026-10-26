<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Abu Salah Musha Lemon">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<title>Stock Genie</title>

	<!-- Base Css Files -->
	<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

	<!-- Font Icons -->
	<link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
	<link href="{{asset('css/material-design-iconic-font.min.css')}}" rel="stylesheet">

	<!-- animate css -->
	<link href="{{asset('css/animate.css')}}" rel="stylesheet" />

	<!-- Waves-effect -->
	<link href="{{asset('css/waves-effect.css')}}" rel="stylesheet">

	<!-- Custom Files -->
	<link href="{{asset('css/helper.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />

	<script src="{{asset('js/modernizr.min.js')}}"></script>

	<style>
		body {
			background-image: url('../images/logo/background5.75.png') !important;
			background-size: auto;
			background-repeat: repeat;
			background-position: center center;
		}
	</style>
</head>


<body>


	<div class="wrapper-page">
		<div class="panel panel-color panel-primary panel-pages">
			<div class="panel-heading bg-img">
				<div class="bg-overlay"></div>
				<h3 class="text-center m-t-10 text-white"> Sign In to <strong>Stoke Genie</strong> </h3>
			</div>


			<div class="panel-body">
				<form method="POST" action="{{ route('login') }}" class="form-horizontal m-t-20">
					@csrf


					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control input-lg " id="email" class="block mt-1 w-full" type="email" name="email"
								:value="old('email')" required autofocus autocomplete="username">
							<x-input-error :messages="$errors->get('email')" class="mt-2" />
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12">
							<input class="form-control input-lg" id="password" class="block mt-1 w-full" type="password"
								name="password" required autocomplete="current-password">
							<x-input-error :messages="$errors->get('password')" class="mt-2" />

						</div>
					</div>

					<!-- <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            
                        </div>
                    </div> -->

					<!-- Remember Me -->
					<div class="block mt-4">
						<label for="remember_me" class="inline-flex items-center">
							<input id="remember_me" type="checkbox"
								class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
							<span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
						</label>
					</div>

					<div class="form-group text-center m-t-40">
						<div class="col-xs-12">
							<button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit"> {{ __('Log in')
								}}</button>
						</div>
					</div>

					<div class="form-group m-t-30">
						<div class="col-sm-7">
							@if (Route::has('password.request'))
							<a href="{{ route('password.request') }}"><i class="fa fa-lock m-r-5"></i> {{ __('Forgot your password?')
								}}</a>

							@endif
						</div>

						<!-- <div class="col-sm-5 text-right">
                            <a href="register.html">Create an account</a>
                        </div> -->
					</div>
				</form>
			</div>

		</div>
	</div>


	<script>
		var resizefunc = [];
	</script>
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/waves.js')}}"></script>
	<script src="{{asset('js/wow.min.js')}}"></script>
	<script src="{{asset('js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
	<script src="{{asset('assets/jquery-detectmobile/detect.js')}}"></script>
	<script src="{{asset('assets/fastclick/fastclick.js')}}"></script>
	<script src="{{asset('assets/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('assets/jquery-blockui/jquery.blockUI.js')}}"></script>


	<!-- CUSTOM JS -->
	<script src="{{asset('js/jquery.app.js')}}"></script>

</body>

</html>