<!DOCTYPE html>
<html>
	<head>
		<title>{!! isset($title) ? $title : 'Estudando laravel' !!}</title>
		
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

		<!-- Fonts -->
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	</head>
	<body>
	
		@if(Session::has('message')) 
			<div class="flash alert-info">
				<p>{{ Session::get('message') }}</p>
			</div>
		@endif
		
		@if($errors->any())
			<div class="flash alert-danger">
			@foreach($errors->all() as $error)
			<p>{{ $error }}</p>
			@endforeach
			</div>
		@endif
	
		@yield('content')
		
		<!-- Scripts -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</body>
</html>