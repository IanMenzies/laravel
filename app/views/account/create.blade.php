@extends('layout.main')

@section('content')

<div class='registration'>
	<div class='registrationHeader'>
		<h2>Create new account</h2>
		{{ Form::open(array('route' => 'account-create-post', 'class' => 'registrationForm' )) }}
			{{-- deal with all errors returned from the user input --}}
			@if($errors->any())
				<div class='alert alert-errors'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</div>
			@endif
			{{ Form::email('email', '', array('placeholder' => 'Email')) }}
			{{ Form::text('username', '', array('placeholder' => 'Username')) }}
			{{ Form::text('firstname', '', array('placeholder' => 'Firstname')) }}
			{{ Form::text('lastname', '', array('placeholder' => 'Lastname')) }}
			{{ Form::password('password', array('placeholder' => 'password')) }}
			{{ Form::password('password_confirm', array('placeholder' => 'Confirm Password')) }}
			{{ Form::submit('Create account', array('class' => 'createAccountButton')) }}
			{{ Form::close() }}
	</div>
</div>
@stop