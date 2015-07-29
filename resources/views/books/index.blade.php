@extends('app')

@section('pagetitle')
    Welcome in library
@stop

@section('content')
    @if(Auth::check())
        <h1>List of your books, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}:</h1>	
		
		 <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Author</th>
                <th>Title</th>
                <th>Year</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->genre }}</td>

                </tr>
            @endforeach
			
        </tbody>
    </table>
	{!! $books->render() !!}
    @endif
@stop
