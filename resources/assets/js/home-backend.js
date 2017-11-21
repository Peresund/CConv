$(document).ready(function() {
	$.get('https://openexchangerates.org/api/currencies.json', function(data) {
		$.each(data, function (key) {
			$('#fromCurrency, #toCurrency').append
			(
				"<option>" + key + "</option>"
			);
		});
	});
});