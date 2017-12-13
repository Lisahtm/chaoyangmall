var init_datatables = function() {    
    var config = {
        iDisplayLength: 20,
        lengthMenu: [[20, 30, 50, -1], [20, 30, 50, "所有"]],
        // order: [1, 'asc'],
        pagingType: 'full_numbers',
        processing: true,
        serverSide: true,
        ajax: {
            'url': '/Admin/Stock/get_popular_products',
            'type': 'POST',            
        },
        columns: [
            {'data': 'no'},
            {
                'data': 'name',
                'className': 'product_name',
                'width': '20%',                
            },
            {'data': 'barcode'},
            {'data': 'specification'},
            {'data': 'repertory'},
            {'data': 'sales'},
            {
                'data': 'package_price',
                'render': function(data, type, row, meta) {
                    return "¥" + data;
                }
            },
            {
                'data': 'single_price',
                'render': function(data, type, row, meta) {
                    return "¥" + data;
                }
            },
            {
                'data': 'retail_price',
                'render': function(data, type, row, meta) {
                    return "¥" + data;
                }
            },            
            {
                'data': 'sticky',
                'render': function render(data, type, row, meta) {                                        
                    if (data > 0) {                        
                        return "已顶";
                    } else {
                        return "未顶";                            
                    }
                }
            },
            {
                'data': 'on_sale',
                'render': function render(data, type, row, meta) {                                        
                    if (data > 0) {                        
                        return "在促";
                    } else {
                        return "未促";                            
                    }
                }
            }
            // {
            //     'data': 'service',
            //     'render': function render(data, type, row, meta) {
            //         if (data > 0) {
            //             return service_prefix + data;
            //         }
            //     }
            // }
            // {'data': 'category'},
            // {'data': 'subcategory'},
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]},
            {'searchable': false, 'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]}
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
        }
    };
    $('#dataTables_sales').DataTable(config);

    config = {
        iDisplayLength: 50,
        lengthMenu: [[50, -1], [50, "所有"]],
        // order: [1, 'asc'],
        pagingType: 'full_numbers',
        processing: true,
        serverSide: true,
        ajax: {
            'url': '/Admin/Stock/get_top_users',
            'type': 'POST',
            "data": function(d) {
                return $.extend({}, d, {
                    'isMonth': $('#current_month').get(0).checked?1:0
                });
            }      
        },
        columns: [
            {'data': 'no'},
            {'data': 'name'},
            {'data': 'telephone'},
            {'data': 'shop_name'},
            {'data': 'create_time'},
            {'data': 'points'},
            {'data': 'order_num'},
            {'data': 'total_amount'}
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0, 1, 2, 3, 4, 5, 6, 7]},
            {'searchable': false, 'targets': [0, 1, 2, 3, 4, 5, 6, 7]}
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
        }
    };
    $('#dataTables_users').DataTable(config);
};

var check_current_month = function (){
    $('#current_month').change(function() {
        $('#dataTables_users').DataTable().ajax.reload();
    });
    
};

$(document).ready(function() {
    init_datatables();
    check_current_month();
});
