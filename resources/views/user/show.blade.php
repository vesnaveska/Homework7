@extends('app')

@section('pagetitle')
    Show User
@stop

@section('content')

	{!! HTML::ul($errors->all()) !!}

	<div class="form-group">
			{!! Form::label('firstName', 'First name') !!}		
			{!! Form::text('first_name', $user->first_name, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>

	<div class="form-group">
			{!! Form::label('LastName', 'Last name') !!}
			{!! Form::text('last_name', $user->last_name, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>

	<div class="form-group">
			{!! Form::label('email', 'Email') !!}
			{!! Form::text('email',  $user->email, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>
    <a class="btn btn-small btn-primary" href="{{ URL::to('user') }}">Back</a>

	

@stop