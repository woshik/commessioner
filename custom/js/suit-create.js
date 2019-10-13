$(document).ready(function(){
	$("#add-suit-messages").fadeOut(0);

	$("#createSuitForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$("#add-suit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);		

					$("#createSuitForm")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();

					setTimeout(function() {
						$("#add-suit-messages").fadeOut(500);
					},5000);
				}
				else {
					if(response.messages instanceof Object) {
						$("#add-suit-messages").html('');
						$.each(response.messages, function(index, value) {
								var key = $("#" + index);

								key.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')
								.find('.text-danger').remove();							

								key.after(value);
						});
					}
					else {
						$("#add-suit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);
					}
				} // /else
			} // /if
		});

		

		return false;
	});
});