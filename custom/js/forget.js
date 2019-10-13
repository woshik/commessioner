$(document).ready(function(){
	$("#message").fadeOut();
	$("#forgetForm").unbind('submit').bind('submit', function() {
		
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
					window.location = response.messages;
				}
				else {
					if(response.messages instanceof Object) {
						$("#message").html('');

						$.each(response.messages, function(index, value) {
							$("#message").html('<div class="alert alert-warning alert-dismissible custom-alert" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  value + 
							'</div>');
						});
					}
					else{
						$("#message").html('<div class="alert alert-warning alert-dismissible custom-alert" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);

						setTimeout(function() {
							$("#message").fadeOut(500);
						},4000);
					}
				} // /else
			} // /if
		});
		return false;
	});

	setTimeout(function() {
		$(".toggle-this-message").toggle(500);
	},4000);
	

	$("#passcodeForm").unbind('submit').bind('submit', function() {
		
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
					window.location = response.messages;
				}
				else {
					if(response.messages instanceof Object) {
						$("#message").html('');

						$.each(response.messages, function(index, value) {
							$("#message").html('<div class="alert alert-warning alert-dismissible custom-alert" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  value + 
							'</div>');
						});
					}
					else{
						$("#message").html('<div class="alert alert-warning alert-dismissible custom-alert" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					}
				} // /else
			} // /if
		});
		return false;
	});

	$("#newPasswordForm").unbind('submit').bind('submit', function() {
		
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
					window.location = response.messages;
				}
				else {
					if(response.messages instanceof Object) {
						$("#message").html('');

						$.each(response.messages, function(index, value) {
							$("#message").html('<div class="alert alert-warning alert-dismissible custom-alert" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  value + 
							'</div>');
						});
					}
					else{
						$("#message").html('<div class="alert alert-warning alert-dismissible custom-alert" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					}
				} // /else
			} // /if
		});
		return false;
	});

	$("#resendPasscode").click(function() {
		
		var id = $('#hiddenmailId').val();
		
		$.ajax({
			url  : 'checkpasscode/resendCode',
			type : 'GET',
			data : {
				'hiddenmailId' : id,
			},
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".toggle-this-message").toggle(500);

					setTimeout(function() {
						$(".toggle-this-message").toggle(500);
					},4000);
				}
			} // /if
		});
		return false;
	});
});