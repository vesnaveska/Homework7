@extends('app')

@section('pagetitle')
    Create user
@stop

@section('content')
    {!! HTML::ul($errors->all()) !!}
    {!! Form::open(array('url' => 'user')) !!}
        <div class="form-group">
            {!! Form::label('first_name', 'First name') !!}
            {!! Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('last_name', 'Last name') !!}
            {!! Form::text('last_name', Input::old('last_name'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
        </div>
       
        {!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
@stop