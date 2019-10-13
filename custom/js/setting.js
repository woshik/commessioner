$(document).ready(function(){

	$("#smsIdpasswordForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url: url,
			type: type,
			data: form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$("#update-smsidpassword-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					

					$("#smsIdpasswordForm")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();
				}
				else {
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
			} // /.success
		}); // /ajax

		return false;
	});

	$("#createNewUser").unbind('submit').bind('submit', function() {
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url: url,
			type: type,
			data: form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$("#add-user-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					

					$("#createNewUser")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();
				}
				else {
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
			} // /.success
		}); // /ajax

		return false;
	});

	$("#input-b2").fileinput();
});