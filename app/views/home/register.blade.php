@extends('master')

@section('content')

<div class='row'>
	<div class='span4 offset1'>
		<div class='well'>
			<legend> Register </legend>
				{{ Form::open(array('url' => 'register')) }}
				@if($errors->any())
				<div class='alert alert-errors'>
					<a href='#' class='close' data-dismiss='alert'>&times;</a>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</div>
				@endif
				{{ Form::text('firstname', '',    array('placeholder' => 'Firstname')) }}
				{{ Form::text('lastname',  '',    array('placeholder' => 'Lastname' )) }}
				{{ Form::text('username',  '',    array('placeholder' => 'Username' )) }}
				{{ Form::text('email', '',        array('placeholder' => 'Email'    )) }}
				{{ Form::password('password', '', array('placeholder' => 'Password' )) }}
				{{ Form::submit('Register',       array('class' => 'btn btn-success')) }}
				{{ HTML::link('/', 'Cancel',      array('class' => 'btn btn-danger' )) }}
				{{ Form::close() }}
		</div>
	</div>
</div>
	
@stop