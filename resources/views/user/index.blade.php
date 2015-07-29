@extends('app');

@section('pagetitle')
    Users List
@stop

@section('content')  
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>First name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>

                    <td width="300">
                        <a class="btn btn-small btn-success" href="{{ URL::to('user/' . $user->id) }}">Show this User</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('user/' . $user->id . '/edit') }}">Edit this User</a>

                       {!! Form::open(array('url' => 'user/' . $user->id, 'class' => 'pull-right')) !!}
					   {!! Form::hidden('_method', 'DELETE') !!}
					   {!! Form::submit('Delete this User', array('class' => 'btn btn-warning')) !!}
					   {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
	{!! $users->render() !!}
@stop