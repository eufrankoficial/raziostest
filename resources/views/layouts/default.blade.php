<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pedido - Sua pizza favorita</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/default.min.css') }}"/>
</head>
<body>

	<div id="app">
		<div class="container">
			<span class="logo">
				<img src="{{ asset('assets/images/logo.png') }}">
			</span>

			@yield('content')
		</div>
	</div>


	<script src="{{ asset('assets/js/vue.min.js') }}"></script>
	<script src="{{ asset('assets/js/app.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>
</html>