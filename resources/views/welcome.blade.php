<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 38px;
            }
			
			.hellotext {
				 font-size: 30px;				
			}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
			    <div class="title">Library</div>
				<div class="hellotext">Hello, guest!  Please, login to see your books </br>              
				<a class = "btn btn-primary btn-lg" href="{{ URL::to('auth/login')}}">Login</a></div>
			</p>
            </div>
        </div>
		
		
		<div class="container">
		
    </body>
</html>
