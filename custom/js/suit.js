var manageSuitTable;

$(document).ready(function(){

	$('#sidebar').addClass('active');

	manageSuitTable = $('#manageSuit').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax" : {
			url:"suit/fetchSuitData",
			type: "GET"
		},
		"columnDefs": [
			{
				"targets": [-1],
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
                    key: 'e'
                },
                exportOptions: {
				 	columns: [0,1,2,3,4,5,6]
				},
                title:'মামলা তালিকা',
        	},
    	],
    	select: {
            style: 'multi'
        },
        "lengthMenu": [ [10, 25, 50, 75, 100, 200, -1], [10, 25, 50, 75, 100, 200, "All"] ],
	});
});

function editSuit(suit_id = null)
{
	if(suit_id) {
		/*Clear the form*/
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$("#edit-suit-messages").html('');

		$.ajax({
			url: 'suit/fetchSuitData/'+suit_id,
			type: 'get',
			dataType: 'json',
			success:function(response) {
				$("#editMamlaNo").val(response.mamlaNo);
				$("#editApilkarirNam").val(response.apilkarirNam);
				$('#editProtipokherNam').val(response.protipokherNam);
				$('#editJaharAdese').val(response.jaharAdese);
				$("#editJeAdese").val(response.jeAdese);
				$("#editApilerTarik").val(response.apilerTarik);
				$('#editPorobortiTarik').val(response.tarikAdesh[((response.tarikAdesh).length)-1].porobortiTarik);
				$('#editAdaloterAdesh').val(response.tarikAdesh[((response.tarikAdesh).length)-1].adaloterAdesh);
				$("#editMamlarBiboron").val(response.mamlarBiboron);
				$("#editApilkarirTikana").val(response.apilkarirTikana);
				$('#editApilkarirPhone').val(response.apilkarirPhone);
				$('#editProtipokherTikana').val(response.protipokherTikana);
				$("#editProtipokherPhone").val(response.protipokherPhone);
			} // /successs
		}); // /ajax

		$("#editSuitForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					var url = form.attr('action');
					var type = form.attr('method');


					$.ajax({
						url: url + '/' + suit_id,
						type: type,
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {
								$("#edit-suit-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  response.messages + 
								'</div>');					

								manageSuitTable.ajax.reload(null, false);
							
								$(".form-group").removeClass('has-error').removeClass('has-success');
								$(".text-danger").remove();
							}
							else {
								if(response.messages instanceof Object) {
									$("#edit-suit-messages").html('');
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
									$("#edit-suit-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  response.messages + 
									'</div>');			
								} // /else									
							} // /else
						} // /success
					}); // /ajax

					return false;
				});
	} // /
}


function showDetails(suit_id = null)
{
	if(suit_id) {
		/*Clear the form*/
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: 'suit/fetchSuitData/'+suit_id,
			type: 'get',
			dataType: 'json',
			success:function(response) {
				$("#showMamlaNo").val(response.mamlaNo);
				$("#showApilkarirNam").val(response.apilkarirNam);
				$('#showProtipokherNam').val(response.protipokherNam);
				$('#showJaharAdese').val(response.jaharAdese);
				$("#showJeAdese").val(response.jeAdese);
				$("#showApilerTarik").val(response.apilerTarik);
				$("#showMamlarBiboron").val(response.mamlarBiboron);
				$("#showApilkarirTikana").val(response.apilkarirTikana);
				$('#showApilkarirPhone').val(response.apilkarirPhone);
				$('#showProtipokherTikana').val(response.protipokherTikana);
				$("#showProtipokherPhone").val(response.protipokherPhone);
				console.log($('#createPDFIdField a')[0].attributes.href.nodeValue);

				($('#createPDFIdField a')[0].attributes.href.nodeValue)+=response.mamla_id;

				$('#date_adesh_table tbody').remove();

				var html = '<tbody>';
				for (var i = 0; i < (response.tarikAdesh).length; i++) {
					html += '<tr><td>'+response.tarikAdesh[i].porobortiTarik+'</td><td>'+response.tarikAdesh[i].adaloterAdesh+'</td></tr>';
				}
				html += '</tbody>';

				$('#date_adesh_table').append(html);
			} // /successs
		}); // /ajax
	} // /
}

function deleteSuit()
{
	$("#removeSuitBtn").click('submit', function() {
		var x = $("#manageSuit tbody .selected td:last-child input[type='hidden']");
		var result = false;

		$.each(x, function(index, field){
			result = true;
			$.ajax({
				url: 'suit/remove/' + field.value,
				type: 'GET',
				dataType: 'json',
			});
		});
		if (result) {
			$('#removeSuit').modal('hide');

			setTimeout(function() {
				location.reload(true);
			},2000);
		}
	})
}

function newDateAndAdesh(suit_id=null) {
	if (suit_id) {
		$.ajax({
			url: 'suit/fetchSuitData/'+suit_id,
			type: 'get',
			dataType: 'json',
			success:function(response) {
				$('#newDateAndAdeshMalmaId')[0].innerHTML = '';
				$('#newDateAndAdeshMalmaId')[0].innerHTML += 'মামলা নং : '+response.mamlaNo
			}
		});

		$("#newDateAndAdeshForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					var url = form.attr('action');
					var type = form.attr('method');


					$.ajax({
						url: url + '/' + suit_id,
						type: type,
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {
								$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  response.messages + 
								'</div>');					

								manageSuitTable.ajax.reload(null, false);
								$('#newDateAndAdesh').modal('hide');
								$("#newDateAndAdeshForm")[0].reset();
								$(".form-group").removeClass('has-error').removeClass('has-success');
								$(".text-danger").remove();
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
									$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  response.messages + 
									'</div>');			
								} // /else									
							} // /else
						} // /success
					}); // /ajax

					return false;
				});

	}
}