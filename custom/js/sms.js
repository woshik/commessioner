var manageSmsTable;

$(document).ready(function(){

	$('#sidebar').addClass('active');

	manageSmsTable = $('#manageSms').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		'ajax' : {
			url:'sms/fetchSmsData',
			type: "GET"
		},
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
                    key: 'e'
                },
                title:'এস.এম.এস পাঠানোর তালিকা',
        	},
    	],
    	select: {
            style: 'multi'
        },
        "lengthMenu": [ [10, 25, 50, 75, 100, 200, -1], [10, 25, 50, 75, 100, 200, "All"] ],
	});

	 $('#smsEditor').summernote({
	 	placeholder: 'write your sms here...',
	 	height: 160,
		minHeight: null,
		maxHeight: null,
		focus: true,
		toolbar: [
		    ['style', ['bold', 'italic', 'underline', 'clear']],
		    ['Misc', ['fullscreen','undo','redo','help']]
		],
	 });

	 $("#smsModel").unbind('click').bind('click', function() {
	 	var sms_id = $(this).val();
	 	$.ajax({
	 		url: 'sms/fetchSmsModel/'+sms_id,
			type: 'get',
			dataType: 'json',
			success:function(response) {

				$('#smsModel').val(response.sms_id);
				$('#smsDays').val(response.smsDays);
				$('#maskingName').val(response.maskingName);
				$('#smsEditor').summernote('code', response.smsText);
			}
	 	});
	 });

	$("#createSMSForm").unbind('submit').bind('submit', function() {

		$("#sms-messages").html('');
		
		var form 	= $(this);
		var url 	= form.attr('action');
		var type 	= form.attr('method');
		var select 	= $('#manageSms tbody tr.selected td:first-child input[type=hidden]');
		var data = form.serialize();

		for (var i = select.length - 1; i >= 0; i--) {
			data = data.concat('&');
			data = data.concat(select[i].name+'=on');
		}

		$.ajax({
			url  	: url,
			type 	: type,
			data 	: data,
			dataType: 'json',
			success : function(response) {
				if(response.success === true)
				{
					$("#sms-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');

					manageSmsTable.ajax.reload(null, false);
					$("#sendSmsModel").modal('hide');
					$('#smsEditor').summernote('reset');
					$("#createSMSForm")[0].reset();
					$(".form-group").removeClass('has-error').removeClass('has-success');
					$('.text-danger').remove();
				}
				else
				{
					if (response.messages instanceof Object) 
					{
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
					else
					{
						$("#sendSmsModel").modal('hide');
						$("#createSMSForm")[0].reset();
						$('#smsEditor').summernote('reset');
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$('.text-danger').remove();
						$("#sms-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					}
				} // /else
			} // /if
		});
		return false;
	});
});