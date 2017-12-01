/* global ajaxResponseError */
/* global jsonParseError */

var inputCurrencySelects = "#inputFromCurrency, #inputToCurrency";
var currenciesTableBody = "#currenciesTable > tbody";
var currencyList;

$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
		}
	});

	loadTable();

	$("#updateCurrenciesButton").on("click", function() {
		updateCurrencies();
	});

	$("#clearCurrenciesButton").on("click", function() {
		clearCurrencies();
	});

	$("#inputValue").on("keyup click", function() {
		outputCurrencyConversion(currencyList);
	});

	$("#inputFromCurrency, #inputToCurrency").on("change", function() {
		outputCurrencyConversion(currencyList);
	});
});

function updateCurrencies() {
	var names;
	
	/* X-CSRF-token not allowed by openexchangerates API */
	delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
	$.ajax({
		type: "GET",
		url: "https://openexchangerates.org/api/currencies.json",
		contentType: "application/json; charset=UTF-8",
		success: onGetCurrenciesSuccess,
		error: ajaxResponseError
	});
	$.ajaxSettings.headers["X-CSRF-TOKEN"] = $("meta[name='csrf-token']").attr("content");
	
	function onGetCurrenciesSuccess(json) {
		names = json;
		
		delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
		$.ajax({
			type: "GET",
			url: "https://openexchangerates.org/api/latest.json?app_id=871cac4bb905471fa9d4288873aeb10d",
			contentType: "application/json; charset=UTF-8",
			success: onGetRatesSuccess,
			error: ajaxResponseError
		});
		$.ajaxSettings.headers["X-CSRF-TOKEN"] = $("meta[name='csrf-token']").attr("content");
	}
		
	function onGetRatesSuccess(json) {

		currencies = new Object();
		currencies['rates'] = json.rates;
		currencies['names'] = names;

		$.ajax({
			type: "POST",
			url: "/updateCurrencies",
			contentType: "application/json; charset=utf-8",
			data: JSON.stringify(currencies),
			success: readCurrenciesJson,
			error: ajaxResponseError
		});
	}
}

function clearCurrencies() {
	$.ajax({
		type: "POST",
		url: "/clearCurrencies",
		contentType: "application/json; charset=utf-8",
		success: readCurrenciesJson,
		error: ajaxResponseError
	});
}

function loadTable() {
	$.ajax({
		type: "GET",
		url: "/getCurrencies",
		contentType: "application/json; charset=UTF-8",
		success: readCurrenciesJson,
		error: ajaxResponseError
	});
}

function readCurrenciesJson(json) {
	currencyList = json;
	reloadCurrencies();
}

function reloadCurrencies() {
	fillCurrencyTable(currencyList);
	fillCurrencyOptions(currencyList);
}

function fillCurrencyTable(content) {
	$(currenciesTableBody).html("");
	try {
		$.each(content, function(key, value) {
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
		jsonParseError(error);
	}
}

function fillCurrencyOptions(content) {
	$(inputCurrencySelects).html("");
	try {
		$.each(content, function (key, value) {
			$(inputCurrencySelects).append
			(
				"<option>" + value.iso_4217 + "</option>"
			);
		});
	} catch(error) {
		jsonParseError(error);
	}
}

function getInputRates(currencyList) {
	var fromCurrency = $("#inputFromCurrency").val();
	var toCurrency = $("#inputToCurrency").val();
	var rates = new Object();

	var foundFrom = false, foundTo = false;
	try {
		$.each(currencyList, function(key, value) {
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
		jsonParseError(error);
	}

	return rates;
}

function calculateCurrencyConversion(currencyList) {
	var rates = getInputRates(currencyList);
	var fromValue = $("#inputValue").val();

	return (fromValue / rates.from * rates.to);
}

function outputCurrencyConversion(currencyList) {
	var result = calculateCurrencyConversion(currencyList);
	$("#outputResult").html(result);
}
