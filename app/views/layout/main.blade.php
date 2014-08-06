<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ian Menzies Site</title>
	
	<meta charset="UTF-8">
		{{ HTML::script('js/jquery.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/global.js') }}
		{{ HTML::style('css/bootstrap.css') }}
		{{ HTML::style('css/cookie.css') }}
		{{ HTML::style('css/style.css') }}
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

	<body class="body">
		
		{{-- Cookie Banner--}}
		<div id="cookieBanner">
            <div id="cookieBannerClose"><a href="#">x</a></div>
            This website uses third party cookies exclusively to collect analytics data.
            If you continue browsing or close this notice, you will accept their use.
            <div id="cookieBannerActions">
                <a class="noconsent" href="{{ URL::route('cookies') }}">Learn about this website's cookies</a>
                &mdash;
                <a class="denyConsent" href="#">Disallow cookies</a>
            </div>
        </div>
		{{-- End of Cookie Banner--}}
		
		
		{{--  Display successful registration message --}}
		@if (Session::has('global'))
		<div id="errorMessages">
			<div id="errorMessageClose"><a href="#">x</a></div>
			<p>{{ Session::get('global') }}</p>
		</div>
		@endif

		@include('layout.navigation')
		
		<div class="mainContent">
			<div class="content">	
				<article class="topcontent">

					@yield('content')

				</article>
			</div>
		</div>
		
		@include('layout.footer')
					
	</body>
</html>