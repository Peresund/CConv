var errorDiv = "#testDiv";
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
		calculateCurrency(currencyList);
	});
	
	$("#inputFromCurrency, #inputToCurrency").on("change", function() {
		calculateCurrency(currencyList);
	});
});

function updateCurrencies() {
	/* CSRF-token not allowed by openexchangerates API */
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
				response = JSON.parse(json);
				fillTable(response);
			}
			function onErrorCall(json) {
				response = JSON.parse(json);
				$(errorDiv).append("fail: " + (response.error));
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
		response = JSON.parse(json);
		fillTable(response);
	}
	function onErrorCall(json) {
		response = JSON.parse(json);
		$(errorDiv).append("fail: " + (response.error));
	}
	function onComplete() {
		return;
	}
}

function loadTable() {
	$.ajax({
		type: "GET",
		url: "/getCurrencies",
		contentType: "application/json; charset=utf-8",
		success: onSuccess,
		error: onErrorCall,
		complete: onComplete
	});

	function onSuccess(json) {
		response = JSON.parse(json);
		fillTable(response);
	}
	function onErrorCall(json) {
		response = JSON.parse(json);
		$(errorDiv).append("fail: " + (response.error));
	}
	function onComplete() {
		return;
	}
}

function fillTable(content) {
	currencyList = content;
//	$('#inputFromCurrency, #inputToCurrency').html("");
	$(currenciesTableBody).html("");
	$.each(currencyList, function(key, value) {
//		$('#inputFromCurrency, #inputToCurrency').append(
//			"<option>" + value.iso_4217 + "</option>"
//		);
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
}

function getInputRates(currencyList) {
	var fromCurrency = $("#inputFromCurrency").val();
	var toCurrency = $("#inputToCurrency").val();
	var rates = new Object();
	
	var foundFrom = false, foundTo = false;
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
			return false;	//Break loop
		}
	});
	
	return rates;
}

function calculateCurrency(currencyList) {
	var rates = getInputRates(currencyList);
	var fromValue = $("#inputValue").val();
	
	var result = (fromValue / rates.from * rates.to);
	
	$("#outputResult").html(result);
}