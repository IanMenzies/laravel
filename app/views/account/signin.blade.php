@extends('layout.main')

@section('content')
<div class='login'>
	<div class='loginHeader'>
		<h2> Please Login </h2>
	</div>
		{{ Form::open(array('route' => 'account-sign-in-post', 'class' => 'loginForm')) }}
		@if($errors->any())
			<div class='alert alert-errors'>
				<a href='#' class='close' data-dismiss='alert'>&times;</a>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
		@endif
		{{ Form::text('email',            '', array('placeholder' => 'Email'    )) }}
		{{ Form::password('password', array('placeholder' => 'Password' )) }}
		{{ Form::label('remember :')  }} 
		{{ Form::checkbox('remember',     '', array('placeholder' => 'Remember', 'label' => 'rememberCheckbox'))  }}
		{{ Form::submit('Login',              array('class' => 'loginButton')) }}
		New customer?{{ HTML::link(URL::route('account-create'), 'Register', array('class' => 'registerButton')) }}
		{{ Form::close() }}
</div>
@stop