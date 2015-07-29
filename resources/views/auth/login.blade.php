@extends('app')

@section('pagetitle')
    Login
@stop

@section('content')
    {!! Form::open(array('url' => 'auth/login', 'method' => 'post')) !!}
        {!! HTML::ul($errors->all()) !!}
		{!! csrf_field() !!}

        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('remember', 'Remember me') !!}
            {!! Form::checkbox('remember') !!}
        </div>

        {!! Form::submit('Login', array('class' => 'btn btn-primary')) !!}

        <a class="btn btn-primary" href="/auth/soc">Login with Facebook</a>
    {!! Form::close() !!}
@stop

