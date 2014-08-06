@extends('layout.main')

@section('content')

<div class='forgotPassword'>
	<div class='forgotPasswordHeader'>
		<h2>Forgotten Password</h2>
	</div>
	{{ Form::open(array('route' => 'account-forgot-password-post', 'class' => 'forgotPasswordForm')) }}
		@if($errors->any())
			<div class='alert alert-errors'>
				<a href='#' class='close' data-dismiss='alert'>&times;</a>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</div>
		@endif
		{{ Form::text('email', '', array('placeholder' => 'Email')) }}
		{{ Form::submit('Resend Confirmation Email') }}
	{{ Form::close() }}
</div>
@stop