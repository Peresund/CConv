var errorDiv = "#testDiv";
var currenciesTableBody = "#currenciesTable > tbody";

$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	loadTable();
	
    $('#updateCurrenciesButton').on('click', function(event) {
		event.preventDefault();
		updateCurrencies();
	});
	
    $('#clearCurrenciesButton').on('click', function(event) {
		event.preventDefault();
		clearCurrencies();
	});
});

function updateCurrencies() {
	/* CSRF-token not allowed by openexchangerates */
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
		$.ajaxSettings.headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr('content');
	});
	$.ajaxSettings.headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr('content');
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
	$(currenciesTableBody).html("");
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
}


var jsonTest = '{\
  "disclaimer": "Usage subject to terms: https://openexchangerates.org/terms",\
  "license": "https://openexchangerates.org/license",\
  "timestamp": 1511492400,\
  "base": "USD",\
  "rates": {\
    "AED": 3.673097,\
    "AFN": 68.783,\
    "ALL": 112.89,\
    "AMD": 484.88,\
    "ANG": 1.780217,\
    "AOA": 165.9235,\
    "ARS": 17.396,\
    "AUD": 1.311633,\
    "AWG": 1.786833,\
    "AZN": 1.7,\
    "BAM": 1.651526,\
    "BBD": 2,\
    "BDT": 81.454401,\
    "BGN": 1.649759,\
    "BHD": 0.37756,\
    "BIF": 1754.05,\
    "BMD": 1,\
    "BND": 1.346288,\
    "BOB": 6.966904,\
    "BRL": 3.2216,\
    "BSD": 1,\
    "BTC": 0.000123396051,\
    "BTN": 64.610268,\
    "BWP": 10.407016,\
    "BYN": 1.999505,\
    "BZD": 2.010205,\
    "CAD": 1.27187,\
    "CDF": 1562.881563,\
    "CHF": 0.981402,\
    "CLF": 0.02356,\
    "CLP": 635.1,\
    "CNH": 6.579598,\
    "CNY": 6.5849,\
    "COP": 2978,\
    "CRC": 565.64,\
    "CUC": 1,\
    "CUP": 25.5,\
    "CVE": 94.1,\
    "CZK": 21.450975,\
    "DJF": 178.97,\
    "DKK": 6.277837,\
    "DOP": 48.107454,\
    "DZD": 114.7095,\
    "EGP": 17.693,\
    "ERN": 15.214764,\
    "ETB": 27.37234,\
    "EUR": 0.843495,\
    "FJD": 2.0769,\
    "FKP": 0.7517,\
    "GBP": 0.7517,\
    "GEL": 2.711825,\
    "GGP": 0.7517,\
    "GHS": 4.625008,\
    "GIP": 0.7517,\
    "GMD": 47.435,\
    "GNF": 9027.15,\
    "GTQ": 7.349486,\
    "GYD": 207.615,\
    "HKD": 7.81018,\
    "HNL": 23.661095,\
    "HRK": 6.381611,\
    "HTG": 63.675,\
    "HUF": 263.5,\
    "IDR": 13499.567183,\
    "ILS": 3.51251,\
    "IMP": 0.7517,\
    "INR": 64.645,\
    "IQD": 1167.15,\
    "IRR": 34767,\
    "ISK": 103.51,\
    "JEP": 0.7517,\
    "JMD": 126.065,\
    "JOD": 0.709503,\
    "JPY": 111.32139036,\
    "KES": 103.295,\
    "KGS": 69.726119,\
    "KHR": 4040,\
    "KMF": 416.979451,\
    "KPW": 900,\
    "KRW": 1084.8,\
    "KWD": 0.302199,\
    "KYD": 0.833466,\
    "KZT": 330.045,\
    "LAK": 8326.05,\
    "LBP": 1516.15,\
    "LKR": 153.745,\
    "LRD": 124.924071,\
    "LSL": 13.873311,\
    "LYD": 1.370001,\
    "MAD": 9.4122,\
    "MDL": 17.377,\
    "MGA": 3212.9,\
    "MKD": 51.94,\
    "MMK": 1356.15,\
    "MNT": 2441.282055,\
    "MOP": 8.045331,\
    "MRO": 355.15,\
    "MUR": 34.0025,\
    "MVR": 15.299677,\
    "MWK": 725.202458,\
    "MXN": 18.642902,\
    "MYR": 4.119466,\
    "MZN": 60.918857,\
    "NAD": 13.87125,\
    "NGN": 360.095,\
    "NIO": 30.779369,\
    "NOK": 8.132534,\
    "NPR": 103.372151,\
    "NZD": 1.451168,\
    "OMR": 0.385052,\
    "PAB": 1,\
    "PEN": 3.236504,\
    "PGK": 3.212559,\
    "PHP": 50.635,\
    "PKR": 105.31,\
    "PLN": 3.550588,\
    "PYG": 5663.85,\
    "QAR": 3.6417,\
    "RON": 3.924499,\
    "RSD": 100.67,\
    "RUB": 58.4561,\
    "RWF": 857.68,\
    "SAR": 3.750216,\
    "SBD": 7.941472,\
    "SCR": 13.6435,\
    "SDG": 6.677447,\
    "SEK": 8.291334,\
    "SGD": 1.345559,\
    "SHP": 0.7517,\
    "SLL": 7637.5,\
    "SOS": 578.58,\
    "SRD": 7.448,\
    "SSP": 130.2634,\
    "STD": 20691.531632,\
    "SVC": 8.752347,\
    "SYP": 514.97999,\
    "SZL": 13.878204,\
    "THB": 32.66,\
    "TJS": 8.822188,\
    "TMT": 3.499986,\
    "TND": 2.498199,\
    "TOP": 2.29066,\
    "TRY": 3.922104,\
    "TTD": 6.730762,\
    "TWD": 30.005,\
    "TZS": 2245.55,\
    "UAH": 26.816338,\
    "UGX": 3638,\
    "USD": 1,\
    "UYU": 29.368469,\
    "UZS": 8087.35,\
    "VEF": 10.273815,\
    "VND": 22710.841255,\
    "VUV": 106.666493,\
    "WST": 2.563738,\
    "XAF": 553.296326,\
    "XAG": 0.05835335,\
    "XAU": 0.00077367,\
    "XCD": 2.70255,\
    "XDR": 0.708794,\
    "XOF": 553.296326,\
    "XPD": 0.00098672,\
    "XPF": 100.655705,\
    "XPT": 0.00106933,\
    "YER": 250.306642,\
    "ZAR": 13.892967,\
    "ZMW": 10.126124,\
    "ZWL": 322.355011\
  }\
}';