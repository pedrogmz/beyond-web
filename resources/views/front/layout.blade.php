<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="{{ config('app.locale') }}"><!--<![endif]-->
	
	<head>
	<!--- Basic page needs
		================================================== -->
		<meta charset="utf-8">
		<title>Beyond2 Battle - Free to play MMORPG</title>
		<meta name="robots" content="index, follow"/>
		<meta name="creator" content="Beyond to Metin2"/>
		<meta name="description" content="{{ config('app.title') }} - MMORPG de Acción Oriental. Descubre nuevas formas de juego, 100% newschool, Equilibrio PvP/PvM. No te lo pierdas, somos más de 500 en línea al día.">
		<meta name="keywords" content="metin2 guabina, metin2, metin2 private server, metin, servidor pvp pvm de metin2, metin2 beyond, beyond to metin2, beyond metin2, mmorpg, f2p, serverlar, private server, mmorpg metin2, pvp metin2, pvm metin2, metin2 pvm, metin2 pvp, servidor pvp de metin2, servidor pvm de metin2"> 
		<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Mobile specific metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
		================================================== -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ asset('css/base.css') }}">
		<!-- <link rel="stylesheet" href="{{ asset('css/vendor.css') }}"> -->
		
		<link rel="stylesheet" href="{{ asset('css/country.css') }}">
		<link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/main.css') }}">
		@yield('css')

	<!-- jQuery
		================================================== -->
		<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>

	<!-- Favicons
		================================================== -->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>

	<body id="top">

	<!-- Header
		================================================== -->
		<header class="short-header">
			<nav class="navbar nav navbar-expand-lg navbar-dark mt2-navbar">
				<div class="container">
					<div class="navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item" {{ currentRoute('home') }}>
								<a class="nav-link" href="{{ route('home') }}">@lang('strings.hHome')</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('ranking') }}">@lang('strings.hRank')</a>
							</li>
							<li class="nav-item" style="visibility: hidden;">
								<a class="nav-link" href="">@lang('Registrate ahora')</a>
							</li>
							@if (Auth::check())
							<a class="nav-link" href="buycoins">
								<li class="nav-item itemshop-menu-btn"><br>
								</li>
								</a>
							@else
								<li class="nav-item register-menu-btn">
									<a class="nav-link" href="register"><div class="nav-play-now"></div><div class="nav-register-now"></div></a><br>
								</li>
							@endif
							<li class="nav-item" {{ currentRoute('home') }}>
								<a class="nav-link" href="https://www.btmt2.com/board/index.php?/forum/47-beyond2-battle-100-pvp/">@lang('strings.hBoard')</a>
							</li>
							<li class="nav-item" {{ currentRoute('home') }}>
								<a class="nav-link" href="https://www.btmt2.com/board/index.php?/calendar/2-old-school-eventos/">@lang('strings.mEvents')</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<div class="logo">
				<a href="{{ url('') }}"></a>
			</div>
		</header>

	<!-- Main content
		================================================== -->
		<main role="main" class="container">
			<div class="row">
				<div style="max-width: 65%;flex: 0 0 65%;" class="col-7">
					<div id="main_content_top"></div>
					@if (session('status'))
					<div id="main_content_mid">
                		@component('front.components.alert')
                    		@slot('type')
                        		success
                    		@endslot
                    		<p>{{ session('status') }}</p>
                		@endcomponent
						</div>
            		@endif
					<div id="main_content_mid">
						@yield('main')
					</div>
					<div id="main_content_bot"></div>
					<div id="main_content_top"></div>
					<div id="main_content_mid">
						<div class="d-flex align-items-center section-header"><span aria-hidden="true" class="info-icon"></span><span class="text">Estadisticas</span></div>
						<div class="main_content_background">
							<div class="row">
								<div class="col-4">
									<span class="text-center">{{ $accountsCreated }}</span><br>
									<span>Accounts created</span>
								</div>
								<div class="col-4">
									<span class="text-center">{{ $charsCreated }}</span><br>
									<span>Characters created</span>
								</div>
								<div class="col-4">
									<span class="text-center">{{ $lastChar }}</span><br>
									<span>Lastest character</span>
								</div>
							</div>
						</div>
					</div>
					<div id="main_content_bot"></div>
				</div>
				<div class="col-4">
					@section('sidebar')
					<!-- User panel widget
						================================================== -->
					<div id="sidebar_top"></div>
					<div class="online text-center position-absolute">
						<div id="online_top"></div>
						<div id="online_mid">
							<div style="width: 100%;font-size: 2.5rem;color:#84C233">{{ $onlinePlayers }}</div>
							@lang('strings.hOnlinePlayers')
						</div>
					</div>
					
					<div style="padding: 0 11% !important;" id="sidebar_mid">
						@if (Auth::check())
							<button type="button" class="ishop-btn"><span class="align-items-center" style="display: flex;"><span aria-hidden="true" class="coin-icon"></span>{{ Auth::user()->coins }} Beyond Coins</span></button>
							<span style="color: #9b7b60; font-size: 1.5rem;">Bienvenido, {{ Auth::user()->login }}.</span>
							<div class="login_blocks"><a class="text-white text-uppercase" href="">Account settings</a></div>
							<div class="login_blocks"><a class="text-white text-uppercase" href="{{route('user/charlist')}}">Character list</a></div>
							<div class="login_blocks"><a class="text-white text-uppercase" href="">Vote 4 us</a></div>
							<a id="logout" href="#"><button class="btn-custom"><span>LOGOUT</span></button></a>
                  			<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                    			{{ csrf_field() }}
                  			</form>
						@else
							<a href="{{ route('download') }}"><button type="button" class="download-btn"><span>Free game download</span></button></a>
							@if (session('confirmation-success'))
								@component('front.components.alert')
									@slot('type')
										success
									@endslot
									{!! session('confirmation-success') !!}
								@endcomponent
							@endif
							@if (session('confirmation-danger'))
								@component('front.components.alert')
									@slot('type')
										error
									@endslot
									{!! session('confirmation-danger') !!}
								@endcomponent
							@endif
							@if (session('warning'))
                        	<div class="alert alert-warning">
                            	{{ session('warning') }}
                        	</div>
                    		@endif
							<form role="form" method="POST" action="{{ route('login') }}">
								{{ csrf_field() }}
								<div class="text" style="display: inline-flex;">SIGN IN</div>
								<div class="form-check pull-right">
									<input type="checkbox" id="remember_me" name="remember_me">
									<label for="remember_me" style="color: #949494; font-size: 1.2rem;" class="form-check-label">
										Remember me
									</label>
								</div>
								@if ($errors->has('username_mt2'))
									@component('front.components.error')
										{{ $errors->first('username_mt2') }}
									@endcomponent
								@endif
								<div class="form-group">
									<input type="text" class="form-control" id="username_mt2" name="username_mt2" aria-describedby="emailHelp" placeholder="Username">
								</div>
								<div style="margin-bottom: 0;" class="form-group">
									<input type="password" class="form-control" id="password_mt2" name="password_mt2" placeholder="Password">
								</div>
								<button type="submit" class="btn-custom"><span>LOGIN</span></button>
							</form>
							<a href="{{ route('password.request') }}"> <small id="emailHelp" class="section_text text-align-center" style="font-size:1.2rem;" class="form-text">Forgot your pass?</small></a>
						@endif
					</div>
					<div id="sidebar_bot"></div>

					<!-- Ranking widget
						================================================== -->
					<div id="sidebar_top"></div>
					<div style="padding: 0 6% !important;" id="sidebar_mid">
						<h1 class="section_text">board of honor</h1>
						<h2 class="section_text text-muted">Player ranking</h2>
						<table style="margin-bottom: 0;" class="table table-custom table-hover">
							<tbody>
								@foreach(array_slice(json_decode($ranking, true), 0, 5) as $key => $value)
								<tr>
									<th scope="row">{{ $key+1 }}</th>
									<td>{{ $value['name'] }}</td>
									<td>Lv. {{ $value['level'] }}</td>
									@if ($value['empire'] === 1)
									    <td><img src="{{ asset('images/shinsoo_flag.png')}}"></td>
									@elseif ($value['empire'] === 2)
									    <td><img src="{{ asset('images/chunjo_flag.png')}}"></td>
									@else
									    <td><img src="{{ asset('images/jinno_flag.png')}}"></td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
						<button type="submit" class="btn-custom"><span>FULL RANK</span></button>
						<br><br>
						<span class="text">Featured video</span>
						<div class="embed-responsive embed-responsive-1by1">
							<iframe class="embed-responsive-item" width="240" height="163" src="https://www.youtube.com/embed/VVMKCuWfZas" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
						</div>
						
					</div>
					<div id="sidebar_bot"></div>
					@show
				</div>
			</div>
		</main>

	<!-- Footer
		================================================== -->
		<footer>
			<div class="footer-bottom">
				<div class="container">  
					<div class="row">
						<div class="col-twelve">
							<div class="copyright">
								<span><a href="{{ url('support') }}" target="_blank">@lang('strings.hSupport')</a></span>
								<span><a href="{{ url('tyc') }}" target="_blank">@lang('strings.hTyC')</a></span>
								<span><a href="{{ url('privacy') }}" target="_blank">@lang('strings.hPyC')</a></span>
							</div>
							<div class="copyright">
								<span>© 2017 - Beyond2 Battle - Free to play MMORPG</span>
								<span>Designed by <a href="https://www.behance.net/Maivindesi3001" target="_blank">Maivin Design</a></span>
							</div>
							<div id="social_networks">
								<a href="https://discord.gg/hXdV7af" target="_blank"><div id="discord"></div></a>
								<a href="https://www.facebook.com/Beyond2Social/" target="_blank"><div id="facebook"></div></a>
								<a href="https://www.youtube.com/channel/UCet4L09QgvjaVHGksW6yyZA" target="_blank"><div id="youtube"></div></a>
								<a href="https://www.elitepvpers.com/forum/metin2-pserver-news/4406889-100-fun-pvp-server-lvl-105-max-beyond2-battle.html" target="_blank"><div id="epvp"></div></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>

		<aside class="languages">
			<ul>
				<li><a href="{{ url('language/en') }}" class="l_en" title="English"></a></li>
				<li><a href="{{ url('language/de') }}" class="l_de" title="Deutsch"></a></li>
				<li><a href="{{ url('language/es') }}" class="l_es" title="Español"></a></li>
				<li><a href="{{ url('language/ro') }}" class="l_ro" title="Romanian"></a></li>
				<li><a href="{{ url('language/pt') }}" class="l_pt" title="Portuguese"></a></li>
			</ul>
		</aside>

		<!-- <div id="preloader">
			<div id="loader"></div>
		</div> -->

   <!-- JavaScript
	================================================== -->
	<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-89155306-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
	<script src="{{ asset('js/plugins.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script>
		$(function() {
			$('#logout').click(function(e) {
				e.preventDefault();
				$('#logout-form').submit()
			})
		})
	</script>

	@yield('scripts')

	</body>
</html>