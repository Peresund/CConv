<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
		<link href="/css/app.css" rel="stylesheet" type="text/css">
		<link href="/css/home.css" rel="stylesheet" type="text/css">
		
    </head>
    <body>
        <div class="position-ref full-height">
            <div class="content">
                <div class="title col-xs-12">
                    Currency Converter
                </div>
				<hr class="gradient col-xs-12" />
				<div class="col-xs-12">
					<form>
						<div class="col-xs-12 col-md-2 col-lg-1">
							<label for="fromCurrency" class="content-item col-xs-12">
								From:
							</label>
							<select id="fromCurrency" class="content-item bottom">
							</select>
						</div>
						<div class="col-xs-12 col-md-6 col-lg-4">
							<label for="val" class="content-item col-xs-12">
								Value:
							</label>
							<input id="val" class="content-item bottom" type="number" step="any" name="fullname" value="" style="width: 100%; max-width: 300px;">
						</div>
						<div class="col-xs-12 col-md-2 col-lg-1">
							<label for="toCurrency" class="content-item col-xs-12">
								To:
							</label>
							<select id="toCurrency" class="content-item bottom">
							</select>
						</div>
						<div class="col-xs-12 col-md-1 col-lg-3">
							<label for="result" class="content-item col-xs-12">
								Result:
							</label>
							<div id="result" class="content-item">0</div>
						</div>
						
						<div class="col-xs-12 col-lg-6" style="clear:both;"></div>
					</form>
				</div>
				
				<hr class="gradient col-xs-12" />
				
                <div class="">
					<button class="btn btn-default">
						Update Currencies
					</button>
					<button class="btn btn-default">
						Clean
					</button>
					
					<br /><br />
					
					<table class="table table-striped table-bordered">
					  <thead>
						<tr>
						  <th>ISO 4217</th>
						  <th>Name</th>
						  <th>Date Created</th>
						  <th>Date Modified</th>
						  <th>Rate</th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						  <td>AED</td>
						  <td>Emiratisk Dirham</td>
						  <td>2015-01-01 00:00:00</td>
						  <td>2015-01-01 00:00:00</td>
						  <td>3.672626</td>
						</tr>
						<tr>
						  <td>ALL</td>
						  <td>Albanian Lek</td>
						  <td>2015-01-01 00:00:00</td>
						  <td>2015-01-01 00:00:00</td>
						  <td>48.3775</td>
						</tr>
						<tr>
						  <td>ANG</td>
						  <td>Neth Antilles Guilder</td>
						  <td>2015-01-01 00:00:00</td>
						  <td>2015-01-01 00:00:00</td>
						  <td>110.223333</td>
						</tr>
					  </tbody>
					</table>
				</div>
				
				<div id="testContent">
					
				</div>
				
            </div>
        </div>
		
		<!-- Scripts -->
		<script src="/js/app.js"></script>
		<script src="/js/home.js"></script>
    </body>
</html>
