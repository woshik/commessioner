var manageStuffTable;
const baseUrl = $("#base_url").val();

$(document).ready(function(){
	manageStuffTable = $('#manageStuff').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		'ajax' : {
			url:'mail/fatchStuffData',
			type: "GET"
		},
		"columnDefs": [
			{
				"targets": [0],
				"orderable": false
			}
		],
		buttons: [
        	{
        		extend: 'selectNone',
        		key: {
                    ctrlKey: true,
                    altKey: true,
                    key: 'd',
                },
        	},
        	{
        		extend: 'selectAll',
        		key: {
                    ctrlKey: true,
                    altKey: true,
                    key: 'a',
                },

        	},
        	{
        		extend: 'excel',
        		key: {
                    ctrlKey: true,
                    altKey: true,
                    key: 'e',
                },
                exportOptions: {
				 	columns: [1,2,3,4]
				},
                title:'কর্মকর্তাবৃন্দের তালিকা',
        	},
    	],
    	select: {
            style: 'multi'
        },
        "lengthMenu": [ [10, 25, 50, 75, 100, 200, -1], [10, 25, 50, 75, 100, 200, "All"] ],
	});

	$("#stuffPhoto").fileinput({
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
	    defaultPreviewContent: '<center><img src="'+baseUrl+"assets/images/default_avatar.png"+'" alt="Your Avatar" style="width:208px;height:200px;"><h6 class="text-muted">Click to select</h6><h6 class="text-muted">Size not more than 2MB</h6></center>',
	    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["jpg", "png", "JPG", "PNG"]
	});

	$("#stuff-message").fadeOut(0);

	$("#createStuffForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data: new FormData(this) ,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			async: false,
			success:function(response) {
				if(response.success === true) {
					$("#stuff-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);		

					manageStuffTable.ajax.reload(null, false);
					$("#addStuffModel").modal('hide')
					$("#createStuffForm")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();

					setTimeout(function() {
						$("#stuff-message").fadeOut(500);
					},3000);
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
					}
					else {
						$("#stuff-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);
						$("#createStuffForm")[0].reset();
						$("#addStuffModel").modal('hide')
					}
				} // /else
			} // /if
		});
		return false;
	});

	$('#emailBody').summernote({
		toolbar: [
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['font', ['strikethrough', 'superscript', 'subscript']],
		    ['fontsize', ['fontsize']],
		    ['color', ['color']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['height', ['paragraph','height']],
		    ['insert',['hr','table','link','picture','video',]],
		    ['misc', ['undo','redo']]
		],
		placeholder: 'write your text here...',
	 	height: 200,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true,
	});

	$('#smsBody').summernote({
	 	placeholder: 'write your sms here...',
	 	height: 200,
		minHeight: null,
		maxHeight: null,
		focus: true,
		toolbar: [
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['Misc', ['fullscreen','undo','redo']],
		],
	 });

});

function deleteStuff()
{
	$("#removeStuffBtn").click('click', function() {
		var x = $("#manageStuff tbody .selected td:last-child input[type='hidden']");
		var result = false;
		$.each(x, function(index, field){
			result = true;
			console.log(field.value);
			$.ajax({
				url: 'mail/remove/' + field.value,
				type: 'GET',
				dataType: 'json',
			}); // /ajax
		});
		if (result) {
			$('#removeStuffModel').modal('hide');

			setTimeout(function() {
				location.reload(true);
			},2000);
		}
	})
} // /remove class

function emailModelOpen() {
	$('#emailBody').summernote('reset');
	var td = $("#manageStuff tbody .selected td:nth-child(4)");
	var email = [];

	for (var i = td.length - 1; i >= 0; i--) {
		email.push(td[i].innerText);
	}
	email = email.join(', ')
	$('#emailAddress').val(email);

	$("#sendEmailModelForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : new FormData(this) ,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			async: false,
			success:function(response) {
				if(response.success === true) {
					$("#stuff-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);

					manageStuffTable.ajax.reload(null, false);
					$("#sendEmailModel").modal('hide')
					$("#sendEmailModelForm")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();

					setTimeout(function() {
						$("#stuff-message").fadeOut(500);
					},3000);
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
					}
					else {
						$("#stuff-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);

						$("#sendEmailModel").modal('hide')
						$("#sendEmailModelForm")[0].reset();
					}
				} // /else
			} // /if
		});
		return false;
	});

}

function smsModelOpen() {
	$('#smsBody').summernote('reset');
	var td = $("#manageStuff tbody .selected td:nth-child(3) ");
	var phone = [];

	for (var i = td.length - 1; i >= 0; i--) {
		phone.push(td[i].innerText);
	}
	phone = phone.join(', ');
	$('#phoneNumber').val(phone);

	$("#sendSMSForm").unbind('submit').bind('submit', function() {
		
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
					$("#stuff-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);

					manageStuffTable.ajax.reload(null, false);
					$("#sendSMSModel").modal('hide')
					$("#sendSMSForm")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$(".text-danger").remove();

					setTimeout(function() {
						$("#stuff-message").fadeOut(500);
					},3000);
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
					}
					else {
						$("#stuff-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>').fadeIn(500);

						$("#sendSMSModel").modal('hide')
						$("#sendSMSForm")[0].reset();
					}
				} // /else
			} // /if
		});
		return false;
	});

}	

