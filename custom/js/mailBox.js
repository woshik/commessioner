var manageEmailTable;
var manageSMSTable;

$(document).ready(function(){
	manageEmailTable = $('#manageEmailData').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		'ajax' : {
			url:'fatchEmailData',
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
                    key: 'e',
                },
                exportOptions: {
				 	columns: [0,1,2]
				},
                title:'ই-মেইল তালিকা',
        	},
    	],
    	select: {
            style: 'multi'
        },
        "lengthMenu": [ [10, 25, 50, 75, 100, 200, -1], [10, 25, 50, 75, 100, 200, "All"] ],
	});

	manageSMSTable = $('#manageSmsData').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		'ajax' : {
			url:'fatchSMSData',
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
                    key: 'e',
                },
                exportOptions: {
				 	columns: [0,1,2]
				},
                title:'এস.এম.এস তালিকা',
        	},
    	],
    	select: {
            style: 'multi'
        },
        "lengthMenu": [ [10, 25, 50, 75, 100, 200, -1], [10, 25, 50, 75, 100, 200, "All"] ],
	});

});