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
	/* X-CSRF-token not allowed by openexchangerates API */
	delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
	$.get("https://openexchangerates.org/api/currencies.json", function(names) {
		delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
		$.get("https://openexchangerates.org/api/latest.json?app_id=871cac4bb905471fa9d4288873aeb10d", function(rates) {
			currencies = new Object();
			currencies['rates'] = rates.rates;
			currencies['names'] = names;

			$.ajax({
				type: "POST",
				url: "/updateCurrencies",
				contentType: "application/json; charset=utf-8",
				data: JSON.stringify(currencies),
				success: onSuccess,
				error: onErrorCall,
				complete: onComplete
			});

			function onSuccess(json) {
				fillCurrencyTable(json);
			}
			function onErrorCall(jqXHR, textStatus, errorThrown) {
				AJAX_RESPONSE_ERROR(jqXHR, textStatus, errorThrown);
			}
			function onComplete() {
				return;
			}
		});
		$.ajaxSettings.headers["X-CSRF-TOKEN"] = $("meta[name='csrf-token']").attr("content");
	});
	$.ajaxSettings.headers["X-CSRF-TOKEN"] = $("meta[name='csrf-token']").attr("content");
}

function clearCurrencies() {
	$.ajax({
		type: "POST",
		url: "/clearCurrencies",
		contentType: "application/json; charset=utf-8",
		success: onSuccess,
		error: onErrorCall,
		complete: onComplete
	});

	function onSuccess(json) {
		fillCurrencyTable(json);
	}
	function onErrorCall(jqXHR, textStatus, errorThrown) {
		AJAX_RESPONSE_ERROR(jqXHR, textStatus, errorThrown);
	}
	function onComplete() {
		return;
	}
}

function loadTable() {
	$.ajax({
		type: "GET",
		url: "/getCurrencies",
		contentType: "application/json; charset=UTF-8",
		success: onSuccess,
		error: onErrorCall,
		complete: onComplete
	});

	function onSuccess(json) {
		fillCurrencyTable(json);
	}
	function onErrorCall(jqXHR, textStatus, errorThrown) {
		AJAX_RESPONSE_ERROR(jqXHR, textStatus, errorThrown);
	}
	function onComplete() {
		return;
	}
}

function fillCurrencyTable(content) {
	currencyList = content;
	$(currenciesTableBody).html("");
	try {
		$.each(currencyList, function(key, value) {
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
		JSON_PARSE_ERROR(error);
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
		JSON_PARSE_ERROR(error);
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
