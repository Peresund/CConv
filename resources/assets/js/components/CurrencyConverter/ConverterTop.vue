
<template>
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
</template>

<script>
	$.get('https://openexchangerates.org/api/currencies.json', function(data) {
		$.each(data, function (key) {
			$('#fromCurrency, #toCurrency').append
			(
				"<option>" + key + "</option>"
			);
		});
	});
</script>
