<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title></title>
		{{ HTML::script('js/jquery.js') }}
		{{ HTML::script('js/global.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::style('css/bootstrap.css') }}
		{{ HTML::style('css/global.css') }}
	</head>
	<body>

		<div class="row-fluid">
			<div class="span12 well">
				<h1> Example Website </h1>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<ul class="nav nav-list well">
					@if(Auth::user())
						<li class="nav-header">{{ ucwords(Auth::user()->username) }}</li>
						<li>{{ HTML::link('post', 'Add post') }}</li>
						<li>{{ HTML::link('users', 'View Users') }}</li>
						<li>{{ HTML::link('logout', 'Logout') }}<li>
					@else
						@if(!preg_match('/login/', Request::url()))
					    <li>{{ HTML::link('login', 'Login') }} </li>
						<li>{{ HTML::link('register', 'Register') }}</li>
						@else
						<li>{{ HTML::link('/', 'Home') }}</li>
						@endif
					@endif 					
				</ul>
			</div>
			<div class="span9">
				@yield('content')
			</div>
		</div>
	</body>
</html>