@extends('app')

@section('pagetitle')
  Edit Book
@stop

@section('content')

	{!! HTML::ul($errors->all()) !!}

	{!! Form::model($book, array('route' =>array('userbook.update' , $book->id), 'method' => 'PUT')) !!}

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
            {!! Form::text('genre', Input::old('genre'),  array('class' => 'form-control')) !!}
	</div>

	<div class="form-group">
		    {!! Form::label('user_id', 'User_id') !!}
            {!! Form::text('user_id', Input::old('user_id'),  array('class' => 'form-control')) !!}
	</div>
	{!! Form::submit('Update', array('class' => 'btn btn-small btn-primary')) !!}
	
	{!! Form::close() !!}
@stop