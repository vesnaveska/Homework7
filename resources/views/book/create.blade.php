@extends('app')

@section('pagetitle')
    Create book
@stop

@section('content')
    {!! HTML::ul($errors->all()) !!}
    {!! Form::open(array('url' => 'book')) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', Input::old('title'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('author', 'Author') !!}
            {!! Form::text('author', Input::old('author'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('year', 'Year') !!}
            {!! Form::text('year', Input::old('year'), array('class' => 'form-control')) !!}
        </div>
		
		 <div class="form-group">
            {!! Form::label('genre', 'Genre') !!}
            {!! Form::text('genre', Input::old('genre'), array('class' => 'form-control')) !!}
        </div>
       
        {!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
@stop