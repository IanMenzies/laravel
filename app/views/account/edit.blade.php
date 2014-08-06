@extends('layout.main')

@section('content')

<div class='registration'>
	<div class='registrationHeader'>
		<h2>Account details</h2>
		{{ Form::open(array('route' => 'account-edit-details-post', 'class' => 'registrationForm')) }}
			{{-- deal with all errors returned from the user input --}}
			@if($errors->any())
				<div class='alert alert-errors'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</div>
			@endif
			{{ Form::label('userName', 'Username:'), Auth::user()->userName }}
			{{ Form::label('email', 'Email:'), Auth::user()->email }}
			{{ Form::text('firstname', Auth::user()->firstName, array('placeholder' => 'Firstname')) }}
			{{ Form::text('lastname', Auth::user()->lastName, array('placeholder' => 'Lastname')) }}
			{{ Form::password('old_password', array('placeholder' => 'Old Password')) }}
			{{ Form::password('password', array('placeholder' => 'New Password')) }}
			{{ Form::password('password_confirm', array('New Password')) }}
			{{ Form::submit('Update account') }}
		{{ Form::close() }}
	</div>
</div>
@stop