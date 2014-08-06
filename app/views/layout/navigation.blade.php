<header class="mainHeader">
	{{ HTML::image("img/IanMenzies.png") }}
	<nav>
		<ul> {{ $currentPage = ""; }}
			<li {{ $currentPage == 'home' ? 'class="active"' : ''}}><a href="{{ URL::route('home') }}">Home</a></li>
			@if (Auth::check())
				<li {{ $currentPage == 'account-sign-out' }}><a href="{{ URL::route('account-sign-out') }}">logout</a></li>
				<li {{ $currentPage == 'account-dashboard' ? 'class="active"' : ''}}><a href="{{ URL::route('account-dashboard') }}">My account</a></li>
			@else
				<li {{ $currentPage == 'account-sign-in' ? 'class="active"' : ''}}><a href="{{ URL::route('account-sign-in') }}">Login</a></li> 
				<li {{ $currentPage == 'account-create' ? 'class="active"' : ''}}><a href="{{ URL::route('account-create') }}">Create an account</a></li>
				<li {{ $currentPage == 'account-forgot-password' ? 'class="active"' : ''}}><a href="{{ URL::route('account-forgot-password') }}">Forgotten Password</a></li>
			@endif
		</ul>
	</nav>
</header>