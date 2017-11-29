var errorHolder = "#errorHolder";
var errorOutput = "#errorOutput";

function closeError() {
	$(errorHolder).hide();
}

function jsonParseError(error) {
	$(errorHolder).show();

	var output = "<p>Error occured while parsing JSON response:<br />";
	output += "<code><em>" + (error) + "</em></code><p>";

	$(errorOutput).html(output);
}

function ajaxResponseError(jqXHR, textStatus, errorThrown) {
	$(errorHolder).show();

	var output = "<p>Ajax response " + textStatus + ": " + (errorThrown) + "</p>";
	output += "<div class='jqXHR-list'>";
	$.each(jqXHR, function(key, value) {
		output += "<p>" + key + ": " + value + "</p>";
	});
	output += "</div>";

	$(errorOutput).html(output);
}
