var TableDatatablesResponsive = function () {
    var initTable1 = function () {

        var table = $('#sample_1');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });

    }
    var initTable2 = function () {

        var table = $('#sample_2');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });

    }
    var initTable3 = function () {

        var table = $('#sample_3');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });
    }
    var initTable4 = function () {

        var table = $('#sample_4');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });

    }
    var initTable5 = function () {
        var table = $('#sample_5');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });
    }
    var initTable_updates_services_requests = function () {
        var table = $('#updates_services_requests');
        var oTable = table.dataTable({
    		"bPaginate": false,
    		"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
			"columnDefs": [
			  { "width": "40%", "targets": 3 }
			],
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });
    }
    var initTable_genral = function () {
        var table = $('#genral');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });
    }
    var initTable_delivery_requests = function () {
        var table = $('#delivery_requests');
        var oTable = table.dataTable({
    		//"bPaginate": false,
    		//"bInfo": false,
            "language": {

                "aria": {

                    "sortAscending": ": activate to sort column ascending",

                    "sortDescending": ": activate to sort column descending"

                },

                "emptyTable": "No data available in table",

                "info": "Showing _START_ to _END_ of _TOTAL_ entries",

                "infoEmpty": "No entries found",

                "infoFiltered": "(filtered1 from _MAX_ total entries)",

                "lengthMenu": "_MENU_ entries",

                "search": "Search:",

                "zeroRecords": "No matching records found"

            },
            buttons: [
            ],
			"columnDefs": [
			  { "width": "40%", "targets": 2 }
			],
            responsive: {
                details: {
                }
            },
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            "pageLength": 10,
        });
    }
    return {
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            initTable1();
            initTable2();
            initTable3();
            initTable4();
            initTable5();
            initTable_updates_services_requests();
            initTable_genral();
            initTable_delivery_requests();
			//alert('inatialized');
        }
    };
}();
jQuery(document).ready(function() {
    TableDatatablesResponsive.init();
});