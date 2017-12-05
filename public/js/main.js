/* global converter */
/* global errorHandler */

$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		}
	});

	converter.loadTable();

	$("#updateCurrenciesButton").on("click", function() {
		converter.updateCurrencies();
	});

	$("#clearCurrenciesButton").on("click", function() {
		converter.clearCurrencies();
	});

	$("#inputValue").on("keyup click", function() {
		converter.outputCurrencyConversion();
	});

	$("#inputFromCurrency, #inputToCurrency").on("change", function() {
		converter.outputCurrencyConversion();
	});
	
	$("#errorCloser").on("click", function() {
		errorHandler.closeError();
	});
});
