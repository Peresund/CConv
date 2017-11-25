
<template>
	<div class="col-xs-12">
		<div class="col-xs-12 col-md-2 col-lg-1">
			<label for="inputFromCurrency" class="content-item col-xs-12">
				From:
			</label>
			<select id="inputFromCurrency" class="content-item bottom">
			</select>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-4">
			<label for="inputValue" class="content-item col-xs-12">
				Value:
			</label>
			<input id="inputValue" class="content-item bottom" type="number" step="any" name="fullname" value="" style="width: 100%; max-width: 300px;">
		</div>
		<div class="col-xs-12 col-md-2 col-lg-1">
			<label for="inputToCurrency" class="content-item col-xs-12">
				To:
			</label>
			<select id="inputToCurrency" class="content-item bottom">
			</select>
		</div>
		<div class="col-xs-12 col-md-1 col-lg-3">
			<label for="outputResult" class="content-item col-xs-12">
				Result:
			</label>
			<div id="outputResult" class="content-item">0</div>
		</div>

		<div class="col-xs-12 col-lg-6" style="clear:both;"></div>
	</div>
</template>

<script>
	$.get('https://openexchangerates.org/api/currencies.json', function(data) {
		$.each(data, function (key, value) {
			$('#inputFromCurrency, #inputToCurrency').append
			(
				"<option>" + key + "</option>"
			);
		});
	});
</script>
