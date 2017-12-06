
/**
 * ErrorHandler namespace
 */
var errorHandler = {};

/**
 * Initialize errorHandler namespace
 */
(function() {
	errorHandler.jsonParseError = function(error) {
		$(errorHolder).show();

		var output = "<p>Error occured while parsing JSON response:<br />";
		output += "<code><em>" + (error) + "</em></code><p>";

		$(errorOutput).html(output);
	};

	errorHandler.ajaxResponseError = function(jqXHR, textStatus, errorThrown) {
		$(errorHolder).show();
		
		var output = "";
		if (jqXHR.getResponseHeader("X-Error-Known") === "true") {
			output += jqXHR.responseText;
		} else if (jqXHR.responseText === undefined && jqXHR.status === 0) {
			output += "Could not connect to the server. Please try again later.";
		} else {
			output += "Unknown server error occured.";
		}
		
		$(errorOutput).html(output);
	};
	
	errorHandler.closeError = function() {
		$(errorHolder).hide();
	};

	var errorHolder = "#errorHolder";
	var errorOutput = "#errorOutput";
})();
