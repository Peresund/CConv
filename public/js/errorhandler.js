
/**
 * ErrorHandler namespace
 */
var errorHandler = {};

/**
 * Initializes errorHandler namespace
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

		var output = "<p>Ajax response " + textStatus + ": " + (errorThrown) + "</p>";
		output += "<div class='jqXHR-list'>";
		$.each(jqXHR, function(key, value) {
			output += "<p>" + key + ": " + value + "</p>";
		});
		output += "</div>";

		$(errorOutput).html(output);
	};
	
	errorHandler.closeError = function() {
		$(errorHolder).hide();
	};

	var errorHolder = "#errorHolder";
	var errorOutput = "#errorOutput";
})();
