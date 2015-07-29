@extends('app')

@section('pagetitle')
    Show Book
@stop

@section('content')

	{!! HTML::ul($errors->all()) !!}

	<div class="form-group">
			{!! Form::label('title', 'Title') !!}		
			{!! Form::text('title', $book->title, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>

	<div class="form-group">
			{!! Form::label('author', 'Author') !!}
			{!! Form::text('author', $book->author, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>

	<div class="form-group">
			{!! Form::label('year', 'Year') !!}
			{!! Form::text('year', $book->year, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>
	
	<div class="form-group">
			{!! Form::label('genre', 'Genre') !!}
			{!! Form::text('genre', $book->genre, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>
	
	<div class="form-group">
			{!! Form::label('user_id', 'User_id') !!}
			{!! Form::text('user_id', $book->user_id, array('class' => 'form-control', 'readonly' => true)) !!}
	</div>
	
    <a class="btn btn-small btn-primary" href="{{ URL::to('userbook') }}">Back</a>

	

@stop