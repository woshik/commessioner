$(document).ready(function(){

	setInterval(messagebox, 1000);


	$("#errorLogClearBtn").unbind('click').bind('click', function() {
		$.ajax({
			url: 'errorlog/logClear',
			type: 'get',
			dataType: 'json',
		});
	});

});

function messagebox(argument) {
	var text = '';
	$.ajax({
		url  : "errorlog/showError",
		type : "GET",
		dataType: 'json',
		success:function(response) {
			for (var i = 0; i < response.length; i++) {
				text += "<div class='eachlog'>"+response[i].sms_error_log+"<span class='dateAndtimeRange'>"+response[i].time+"</span></div>";
			}
			$("#errorlogbox").html(text);
		} // /if
	});
}