@extends('app');

@section('pagetitle')
    Books and their Users
@stop

@section('content')  
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Author</th>
                <th>Title</th>
                <th>Year</th>
                <th>Genre</th>
				<th>User</th>
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
					<td>{{ $book->user_id }}</td>
					
					<td width="300">
                        <a class="btn btn-small btn-success" href="{{ URL::to('userbook/' . $book->id) }}">Show this link</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('userbook/' . $book->id . '/edit') }}">Edit this link</a>

                       {!! Form::open(array('url' => 'userbook/' . $book->id, 'class' => 'pull-right')) !!}
					   {!! Form::hidden('_method', 'DELETE') !!}
					   {!! Form::submit('Delete this link', array('class' => 'btn btn-warning')) !!}
					   {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
{!! $books->render() !!}
@stop