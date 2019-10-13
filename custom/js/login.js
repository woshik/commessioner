$(document).ready(function(){
	$("#loginForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$("#message").fadeOut(0);
		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					window.location = response.messages;
				}
				else {
					if(response.messages instanceof Object) {
						$("#message").html('');

						$.each(response.messages, function(index, value) {
							var key = $("#" + index);
							if (value) {
								key.parent().addClass('alert-validate');
							}
						});
					}
					else{
						$("#message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);

						setTimeout(function() {
							$("#message").fadeOut(500);
						},3000);
					}
				} // /else
			} // /if
		});
		return false;
	});
});