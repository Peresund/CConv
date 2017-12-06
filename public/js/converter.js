/* global errorHandler */

/**
 * Converter namespace
 */
var converter = {};

/**
 * Initialize converter namespace
 */
(function() {
	
	/*
	 * ============
	 * Public scope 
	 * ============
	 */
	
	converter.updateCurrencies = function() {
		$.ajax({
			type: "POST",
			url: "/updateCurrencies",
			contentType: "application/json; charset=utf-8",
			success: readCurrenciesJson,
			error: errorHandler.ajaxResponseError
		});
	};

	converter.clearCurrencies = function() {
		$.ajax({
			type: "POST",
			url: "/clearCurrencies",
			contentType: "application/json; charset=utf-8",
			success: readCurrenciesJson,
			error: errorHandler.ajaxResponseError
		});
	};

	converter.loadTable = function() {
		$.ajax({
			type: "GET",
			url: "/getCurrencies",
			contentType: "application/json; charset=UTF-8",
			success: readCurrenciesJson,
			error: errorHandler.ajaxResponseError
		});
	};

	converter.outputCurrencyConversion = function() {
		var result = calculateCurrencyConversion();
		$("#outputResult").html(result);
	};
	
	/*
	 * ============
	 * Private scope 
	 * ============
	 */
	
	var currencies;
	var currenciesTableBody = "#currenciesTable > tbody";
	
	var inputValueDiv = "#inputValue";
	var inputFromCurrencySelect = "#inputFromCurrency";
	var inputToCurrencySelect = "#inputToCurrency";
	var inputCurrencySelects = inputFromCurrencySelect + "," + inputToCurrencySelect;

	function readCurrenciesJson(json) {
		currencies = json;
		reloadCurrencies();
	};

	function reloadCurrencies() {
		fillCurrencyTable();
		fillCurrencyOptions();
	};

	function fillCurrencyTable () {
		$(currenciesTableBody).html("");
		try {
			$.each(currencies, function(key, value) {
				$(currenciesTableBody).append(
					"<tr>" +
						"<td>" + value.iso_4217 + "</td>" +
						"<td>" + value.name + "</td>" +
						"<td>" + value.date_created + "</td>" +
						"<td>" + value.date_modified + "</td>" +
						"<td>" + value.rate + "</td>" +
					"</tr>"
				);
			});
		} catch(error) {
			errorHandler.jsonParseError(error);
		}
	};

	function fillCurrencyOptions () {
		$(inputCurrencySelects).html("");
		try {
			$.each(currencies, function (key, value) {
				$(inputCurrencySelects).append
				(
					"<option>" + value.iso_4217 + "</option>"
				);
			});
		} catch(error) {
			errorHandler.jsonParseError(error);
		}
	};

	function getInputRates() {
		var fromCurrency = $(inputFromCurrencySelect).val();
		var toCurrency = $(inputToCurrencySelect).val();
		var rates = new Object();

		var foundFrom = false, foundTo = false;
		try {
			$.each(currencies, function(key, value) {
				if (value.iso_4217 === fromCurrency) {
					rates.from = value.rate;
					foundFrom = true;
				}
				if (value.iso_4217 === toCurrency) {
					rates.to = value.rate;
					foundTo = true;
				}
				if (foundFrom && foundTo) {
					return false;	//Break for-each loop
				}
			});
		} catch(error) {
			errorHandler.jsonParseError(error);
		}

		return rates;
	};

	function calculateCurrencyConversion() {
		var rates = getInputRates();
		var fromValue = $(inputValueDiv).val();

		return (fromValue / rates.from * rates.to);
	};
})();
