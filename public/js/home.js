var host = 'ws://localhost:9001';

$(document).ready(function() {
    $('#test-button').on('click', function (e) {
        e.preventDefault();
        var title = $('#title').val();
        var body = $('#body').val();
        var published_at = $('#published_at').val();

            $.ajax({
                type: "GET",
                url: "/test",
                contentType: "application/json; charset=utf-8",
				data: {title: title, body: body, published_at: published_at},
                dataType: "json",
                success: onSuccess,
                error: onErrorCall,
                complete: onComplete
            });

            function onSuccess(response) {
				console.log("success")
            }
            function onErrorCall(response) {
				console.log(response.responseText);
			}
            function onComplete() {
				return;
            }

    });
	
	$.get('https://openexchangerates.org/api/currencies.json', function(data) {
		$.each(data, function (key) {
			$('#fromCurrency, #toCurrency').append
			(
				"<option>" + key + "</option>"
			);
		});
	});
});