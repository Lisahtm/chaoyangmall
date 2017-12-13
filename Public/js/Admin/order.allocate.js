var set_button = function() {
    $('button#allocate_order').click(function() {
        if ($(this).attr('disabled')) { return; }
        var selected_orders = [];
        $('input.order_selector').each(function() {
            if ($(this).get(0).checked) {
                selected_orders.push(parseInt($(this).attr('name')));
            }
        });
        window.location.href = '/Admin/Order/allocation?' + $.param({'orders': selected_orders});
    });

    $('button#delete_order').click(function() {
        if ($(this).attr('disabled')) { return; }
        var selected_orders = [];
        $('input.order_selector').each(function() {
            if ($(this).get(0).checked) {
                selected_orders.push(parseInt($(this).attr('name')));
            }
        });

        $.ajax({
            "type": 'POST',
            "url": "/Admin/Order/delete?" + $.param({'orders': selected_orders}),
            "data": {
                'orders': selected_orders
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {
                    toastr.success(res['msg']);
                }
            },
            "error": function(xhr, error, thrown) {                
                toastr.error(res['msg']);
            }
        });

        // window.location.href = '/Admin/Order/delete?' + $.param({'orders': selected_orders});
    });
};

var set_datatable = function() {
    var update_button = function() {
        var any_selected = false;
        var all_selected = true;
        $('input.order_selector').each(function() {
            any_selected |= $(this).get(0).checked;
            all_selected &= $(this).get(0).checked;
        });

        $('input.all_selector').get(0).checked = all_selected;
        if (any_selected) {
            $('button#allocate_order').removeAttr('disabled');
            $('button#delete_order').removeAttr('disabled');
        } else {
            $('button#allocate_order').attr('disabled', 'disabled');
            $('button#delete_order').attr('disabled', 'disabled');
        }
    };

    $("input.order_selector").change(function() {
        update_button();
    });

    $("input.all_selector").change(function() {
        if ($(this).get(0).checked) {
            $("input.order_selector").each(function() {
                $(this).get(0).checked = true;
            })
        } else {
            $("input.order_selector").each(function() {
                $(this).get(0).checked = false;
            })
        }
        update_button();
    });
};

var format_products = function(products_info) {
    var prefix = '<table cellpadding="8" cellspacing="0" border="0" class="table table-striped table-hover" style="margin-bottom: 0;">' +
        '<thead>' +
        '<tr>' +
        '<th>#</th>' +
        '<th width="25%">商品名称</th>' +
        '<th>条码</th>' +
        '<th>整箱</th>' +
        '<th>单包</th>' +
        '<th>售货服务</th>' +
        '<th>小计</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';
    var suffix = '</tbody></table>';
    var table = prefix;
    for (var i = 0; i < products_info.length; i++) {
        table = table + '<tr>' +
            '<th scope="row">' + products_info[i]['no'] + '</th>' +
            '<td class="product_name">' + products_info[i]['product_name'] + '</td>' +
            '<td>';
        if (products_info[i]['barcode']) {
            table = table + products_info[i]['barcode'];
        }
        table = table + '</td>' + '<td>';
        if (products_info[i]['package_num'] >= 0) {
            if (products_info[i]['package_num'] > 0) {
                table = table + products_info[i]['package_num'] + '&times; ¥' + products_info[i]['package_price'];
            } else {
                table = table + '—';
            }
        }
        table = table + '</td>' + '<td>';
        if (products_info[i]['single_num'] >= 0) {
            if (products_info[i]['single_num'] > 0) {
                table = table + products_info[i]['single_num'] + '&times; ¥' + products_info[i]['single_price'];
            } else {
                table = table + '—';
            }
        }
        table = table + '</td>' + '<td>';
        if (products_info[i]['service']) {
            table = table + service_prefix + products_info[i]['service'];
        }
        table = table + '</td>' +
            '<td>¥' + products_info[i]['total'] + '</td>' +
            '</tr>';
    }
    table = table + suffix;
    return table;
};

var init_datatables = function() {
    var config = {
        iDisplayLength: 50,
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "所有"]],
        order: [1, 'asc'],
        pagingType: 'full_numbers',
        processing: true,
        serverSide: true,
        ajax: {
            'url': '/Admin/Order/get_orders',
            'type': 'POST',
            'data': function(d) {
                return $.extend({}, d, {
                    'state': 1
                });
            }
        },
        columns: [
            {
                'data': 'empty',
                'className': 'control'
            },
            {
                'data': 'id',
                'render': function(data, type, row, meta) {
                    return "<input type='checkbox' class='order_selector' name='" + data + "' />";
                }
            },
            {'data': 'serial_id'},
            {'data': 'create_time'},
            {'data': 'name'},
            {
                'data': 'total_price',
                'render': function(data, type, row, meta) {
                    return "¥" + data;
                }
            },
            {'data': 'telephone'},
            {'data': 'address_name'},
            {
                'data':           null,
                'className':      'details-control',
                'defaultContent': ''
            }
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0, 1, 8]},
            {'searchable': false, 'targets': [0, 1, 3, 5, 6, 7, 8]}
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
            set_datatable();
        }
    };
    var datatable = $('#dataTables').DataTable(config);

    $('#dataTables tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = datatable.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format_products(row.data()['products'])).show();
            tr.addClass('shown');
        }
    });
};

$(document).ready(function() {
    init_datatables();
    set_button();
});
