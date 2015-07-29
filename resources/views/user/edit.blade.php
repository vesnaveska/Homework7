@extends('app')

@section('pagetitle')
  Edit User
@stop

@section('content')

	{!! HTML::ul($errors->all()) !!}

	{!! Form::model($user, array('route' =>array('user.update' , $user->id), 'method' => 'PUT')) !!}

	<div class="form-group">
			{!! Form::label('firstName', 'First name') !!}
			{!! Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) !!}
	</div>

	<div class="form-group">
			{!! Form::label('LastName', 'Last name') !!}
			{!! Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) !!}
	</div>

	<div class="form-group">
			{!! Form::label('email', 'Email') !!}
			{!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
	</div>

	{!! Form::submit('Update', array('class' => 'btn btn-small btn-primary')) !!}
	
	{!! Form::close() !!}
@stop