$(document).ready(function(){

	const baseUrl = $("#base_url").val();
	var src = '';
	$.ajax({
		url: baseUrl+'dashboard/fatchadmin',
		type: 'get',
		dataType: 'json',
		success:function(response){
			$("#adminname").val(response.name);
			$("#adminusername").val(response.username);
			$("#adminEmail").val(response.email);
			$("#adminPhoto").fileinput({
				overwriteInitial: true,
			    maxFileSize: 2000,
			    showClose: false,
			    showCaption: false,
			    showBrowse: false,
			    browseOnZoneClick: true,
			    removeLabel: '',
			    removeIcon: '<i class="fas fa-times"></i>',
    			removeTitle: 'Cancel or reset changes',
			    elErrorContainer: '#kv-avatar-errors-2',
			    msgErrorClass: 'alert alert-block alert-danger',
			    defaultPreviewContent: '<center><img src="'+baseUrl+response.image_src+'" alt="Your Avatar" style="width:208px;height:200px;"><h6 class="text-muted">Click to select</h6><h6 class="text-muted">Size not more than 2MB</h6></center>',
			    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
				allowedFileExtensions: ["jpg", "png", "JPG", "PNG"]
			});
		} // /success
	}); // /ajax


	$("#adminView").unbind('submit').bind('submit', function() {
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url: url,
			type: type,
			data: new FormData(this) ,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			async: false,
			success:function(response) {
				if(response.success === true) {
					location.reload(true);
				}
				else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var key = $("#" + index);

							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.text-danger').remove();							

							key.after(value);

						});
					}else{
						$("#update-profile-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					}
				}
			} // /.success
		}); // /ajax

		return false;
	});

});