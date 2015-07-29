<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/>
</head>
<body>

<div class="container">
	<nav class="navbar navbar-inverse">
		<ul class="nav navbar-nav">
			@if(Auth::check())
				<li><a href="{{ URL::to('user')}}">View All Users</a></li>
				<li><a href="{{ URL::to('user/create')}}">Create a User</a></li>
				<li><a href="{{ URL::to('book')}}">View All Books</a></li>
				<li><a href="{{ URL::to('book/create')}}">Create a Book</a></li>
				<li><a href="{{ URL::to('userbook') }}">Books and Users</a></li>
				<li><a href="{{ URL::to('books') }}">Your books</a></li>
			@endif	
		</ul>
		<div class="nav navbar-nav pull-right">
			@if (Auth::check())
				<li><a href="{{ URL::to('auth/logout') }}">Logout</a><li>
			@else
			    <li><a href="{{ URL::to('auth/login') }}">Login</a><li>
			@endif
        </div>
	</nav>

    <h1>@yield('pagetitle')</h1>

    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>