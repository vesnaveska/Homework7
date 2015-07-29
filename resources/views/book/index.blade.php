@extends('app');

@section('pagetitle')
    Books List
@stop

@section('content')  
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Author</th>
                <th>Title</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->genre }}</td>

                    <td width="300">
                        <a class="btn btn-small btn-success" href="{{ URL::to('book/' . $book->id) }}">Show this Book</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('book/' . $book->id . '/edit') }}">Edit this Book</a>

                       {!! Form::open(array('url' => 'book/' . $book->id, 'class' => 'pull-right')) !!}
					   {!! Form::hidden('_method', 'DELETE') !!}
					   {!! Form::submit('Delete this Book', array('class' => 'btn btn-warning')) !!}
					   {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
			
        </tbody>
    </table>
	{!! $books->render() !!}
@stop