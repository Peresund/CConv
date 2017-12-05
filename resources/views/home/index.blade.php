<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Laravel</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

		<!-- Styles -->
		<link href="/css/app.css" rel="stylesheet" type="text/css">
		<link href="/css/home.css" rel="stylesheet" type="text/css">

	</head>
	<body>
		<div id="errorHolder" class="alert alert-danger" hidden>
			<button id="errorCloser" type="button" class="close" aria-label="Close">
				<span>&times;</span>
			</button>
			<div id="errorOutput">

			</div>
		</div>

		<div class="position-ref full-height">
			<div class="content">
				<CurrencyConverter></CurrencyConverter>
			</div>
		</div>

		<!-- Scripts -->
		<script src="/js/app.js"></script>
		<script src="/js/errorhandler.js"></script>
		<script src="/js/converter.js"></script>
		<script src="/js/main.js"></script>
	</body>
</html>
