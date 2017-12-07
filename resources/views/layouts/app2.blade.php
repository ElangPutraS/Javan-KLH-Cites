<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ config('app.name', 'Laravel') }}</title>
    	<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    	<link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('inspinia/css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('inspinia/css/style.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		<style type="text/css">
			.container {
				min-width: 600px;
				max-width: 1024px;
			}
			.navbar-header {
				background-color: #1ab394;
			}
			.navbar-collapse {
				background-color: #1ab394;
			}
			.navbar-brand img:nth-child(1) {
				position: absolute;
				top: 5px;
				width: 71px;
			}
			.navbar-brand img:nth-child(2) {
				position: absolute;
				top: 0px;
				width: 51px;
				margin-left: 81px;
			}
			.navbar-brand span:nth-child(3) {
				position: absolute;
				margin-top: 0;
				margin-left: 140px;
				top: 6px;
				font-size: 16px;
				font-weight: bold;
			}
			.navbar-brand span:nth-child(4) {
				position: absolute;
				margin-top: 0;
				margin-left: 140px;
				top: 23px;
				font-size: 14px;
			}
			#navbar ul li a {
				color: #fff;
			}
			#navbar ul li a:hover {
				color: #1ab394;
			}
			#navbar ul li a:active {
				color: #1ab394;
			}
			#navbar ul li.klh-active a {
				background-color: #fff;
				color: #1ab394;
			}
			.klh-content {
				margin-top: 10px;
				margin-bottom: 10px;
			}
			.footer {
				background-color: #1ab394;
			}
			.footer {
				color: #fff;
			}
			.footer ul#klh-call-us {
				list-style: none;
				margin: 0;
				padding: 0;
			}
			.footer ul#klh-call-us li div:nth-child(1) {
				float: left;
				margin: 0 10px 10px 0;
			}
			.footer ul#klh-find-us {
				list-style: none;
				margin: 0;
				padding: 0;
			}
			.footer ul#klh-find-us li {
				float: left;
				margin-right: 10px;
			}
			.footer ul#klh-find-us li a {
				/*color: #1ab394;*/
				color: #fff;
			}
			.footer ul#klh-find-us li a:hover {
				/*color: #666;*/
				color: #f8ac59;
			}
			.footer .row .col-sm-4:nth-child(1) img:nth-child(1) {
				width: 71px;
				margin-right: 10px;
			}
			.footer .row .col-sm-4:nth-child(1) img:nth-child(2) {
				width: 51px;
			}
			.footer .row .col-sm-4:nth-child(1) span:nth-child(4) {
				font-size: 16px;
				font-weight: bold;
			}
			.footer .row .col-sm-4:nth-child(1) span:nth-child(6) {
				font-size: 14px;
			}
			.footer .row .col-sm-4:nth-child(1) span:nth-child(8) {
				font-size: 12px;
			}
			.footer .row .col-sm-4:nth-child(2) {
				margin-top: 10px;
			}
			.footer .row .col-sm-4:nth-child(3) {
				margin-top: 10px;
			}
			.klh-middle-panel {
				position: fixed;
				top: 40%;
				left: 50%;
				/* bring your own prefixes */
				transform: translate(-50%, -50%);
				width: 600px;
			}
		</style>
	</head>
	<body class="top-navigation">
		<div id="wrapper" class="container">
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom white-bg">
					<nav class="navbar navbar-static-top" role="navigation">
						<div class="navbar-header">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
							<i class="fa fa-reorder"></i>
							</button>
							<a href="{{ url('/') }}" class="navbar-brand">
								<img src="{{ asset('images/CITES_logo_high_resolution_white.png') }}">
		                        <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}">
		                        <span>KEMENTERIAN LINGKUNGAN HIDUP</span>
		                        <span>REPUBLIK INDONESIA</span>
							</a>
						</div>
						<div class="navbar-collapse collapse" id="navbar">
							<ul class="nav navbar-nav navbar-right">
								<li @if(Request::is('/')) class="klh-active" @endif><a aria-expanded="false" role="button" href="{{ url('/') }}">Home</a></li>
	                        	<!-- Authentication Links -->
	                        	@guest
	                            <li @if(Request::is('login')) class="klh-active" @endif><a href="{{ route('login') }}">Login</a></li>
	                            <li @if(Request::is('register')) class="klh-active" @endif><a href="{{ route('register') }}">Register</a></li>
	                        	@else
	                            <li class="dropdown">
	                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
	                                    {{ Auth::user()->name }} <span class="caret"></span>
	                                </a>

	                                <ul class="dropdown-menu">
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
	                                    <li>
	                                        <a href="{{ route('profile') }}">
	                                            My Profile
	                                        </a>
	                                    </li>
	                                </ul>
	                            </li>
	                        	@endguest
							</ul>
						</div>
					</nav>
				</div>

				@yield('content')
				
				<div class="footer">
					<div class="row">
						<div class="col-sm-4">
			                <img src="{{ asset('images/CITES_logo_high_resolution_white.png') }}">
			                <img src="{{ asset('images/Lambang_Kementerian_Lingkungan_Hidup_dan_Kehutanan.png') }}">
			                <br>
			                <span>KEMENTERIAN LINGKUNGAN HIDUP</span>
			                <br>
			                <span>REPUBLIK INDONESIA</span>
			                <br>
			                <span>www.menlh.go.id - Copyright &copy; 2017</span>
			                <!--p class="text-muted">Place sticky footer content here.</p-->
			            </div>

			            <div class="col-sm-4">
			                <h3>Hubungi Kami</h3>
			                <ul id="klh-call-us">
			                	<li>
			                		<div><i class="fa fa-home"></i></div>
			                		<div>Jl. D.I. Panjaitan Kav. 24 Kebon Nanas, Jakarta Timur 13410</div>
			                		<div class="clearfix"></div>
			                	</li>
			                	<li>
			                		<div><i class="fa fa-phone"></i></div>
			                		<div>Telepon: +62 (21) 8580067-68</div>
			                		<div class="clearfix"></div>
			                	</li>
			                </ul>
			            </div>

			            <div class="col-sm-4">
			                <h3>Temukan Kami</h3>
			                <ul id="klh-find-us">
			                    <li><a href="#"><i class="fa fa-facebook fa-2x"></i></a></li>
			                    <li><a href="#"><i class="fa fa-twitter fa-2x"></i></a></li>
			                    <li><a href="#"><i class="fa fa-instagram fa-2x"></i></a></li>
			                </ul>
			            </div>
					</div>
				</div>
			</div>
		</div>
		<!-- Mainly scripts -->
		<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.slim.min.js') }}"></script>
    	<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('inspinia/js/jquery.metisMenu.js') }}"></script>
		<script src="{{ asset('inspinia/js/jquery.slimscroll.min.js') }}"></script>
		<!-- Custom and plugin javascript -->
		<script src="{{ asset('inspinia/js/inspinia.js') }}"></script>
		<script src="{{ asset('inspinia/js/pace.min.js') }}"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    	@stack('body.script')
	</body>
</html>