var init_datatables = function() {    
    var config = {
        iDisplayLength: 50,
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "所有"]],
        order: [1, 'asc'],
        pagingType: 'full_numbers',
        processing: true,
        serverSide: true,
        ajax: {
            'url': '/Admin/Stock/get_stocks',
            'type': 'POST',
            // 'data': function(d) {
            //     return $.extend({}, d, {
            //         'state': 3
            //     });
            // }
        },
        columns: [
            {
                'data': 'empty',
                'className': 'control'
            },
            {'data': 'no'},
            {'data': 'name'},
            {'data': 'barcode'},
            {'data': 'purchase_quantity'},
            {'data': 'specification'},
            {'data': 'purchase_price'},            
            {'data': 'total_amount'},
            {'data': 'purchase_date'},
            {'data': 'package_price'},
            {'data': 'single_price'},
            {'data': 'wholesaler'},
            {'data': 'comment'}
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0, 1, 4, 5, 6, 7, 9, 10]},
            {'searchable': false, 'targets': [0, 1, 4, 5, 6, 9, 10]}
        ],
        language: {
            'url': '/Public/js/Admin/datatables-Chinese.json'
        },
        responsive: {
            details: {
                type: 'column'
            }
        },
        drawCallback: function(settings) {
            // set_datatable();
        }
    };
    $('#dataTables').DataTable(config);
};

$(document).ready(function() {
    init_datatables();
});
