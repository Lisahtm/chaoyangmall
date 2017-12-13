var set_datatable = function() {
    $('a.receive_button').click(function() {
        var order_id = $(this).attr('data-field');
        var btn = $(this);
        btn.unbind('click');
        $.ajax({
            "type": "POST",
            "url": "/Admin/Order/submit_reception",
            "data": {
                'id': order_id
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {
                    var state_html = '已收货';
                    btn.parents('td').html(state_html);
                } else {
                    $('#dataTables').DataTable().ajax.reload();
                }
            },
            "error": function(xhr, error, thrown) {
                btn.bind('click');
            }
        });
    });
};

var format_order = function(data) {
    var table = '<div style="padding: 5px 15px;">' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<p><strong>收货人：</strong>' + data['name'] + '</p>' +
        '</div>' +
        '<div class="col-md-6">' +
        '<p><strong>联系电话：</strong>' + data['telephone'] + '</p>' +
        '</div>' +
        '</div>' +
        '<p><strong>收货地址：</strong>' + data['address_name'] + ' ' + data['address_detail'] + '</p>' +
        '</div>' +
        '<table class="table table-bordered table-striped">' +
        '<thead>' +
        '<tr>' +
        '<th>#</th>' +
        '<th width="20%">商品名称</th>' +
        '<th>条码</th>' +
        '<th>整箱</th>' +
        '<th>单包</th>' +
        '<th>售后服务</th>' +
        '<th>小计</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';
    var products_info = data['products'];
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
    table += '</tbody></table>';
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
                    'state': 3
                });
            }
        },
        columns: [
            {
                'data': 'empty',
                'className': 'control'
            },
            {'data': 'no'},
            {'data': 'serial_id'},
            {'data': 'create_time'},
            {
                'data': 'allocation_id',
                'render': function(data, type, row, meta) {
                    return '<a href="/Admin/Order/print_allocation.html?serial_id=' + data + '&from=receive">' + data + '</a>';
                }
            },
            {
                'data': 'delivery_time',
                'render': function(data, type, row, meta) {
                    return '<a href="/Admin/Order/print_delivery.html?serial_id=' + row['serial_id'] + '&from=receive">' + data + '</a>';
                }
            },
            {'data': 'name'},
            {
                'data':           null,
                'className':      'details-control',
                'defaultContent': ''
            },
            {
                'data': 'id',
                'render': function(data, type, row, meta) {
                    return '<a class="receive_button table_link" data-field="' + data + '" ' +
                        'data-toggle="confirmation" ' +
                        'data-btn-ok-label="是" data-btn-ok-icon="glyphicon glyphicon-ok" data-btn-ok-class="btn-success" ' +
                        'data-btn-cancel-label="否" data-btn-cancel-icon="glyphicon glyphicon-remove" data-btn-cancel-class="btn-danger" ' +
                        'data-title="是否确认收货?" data-singleton="true" data-popout="true" ' +
                        'data-placement="left">确认收货</a>';
                }
            }
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0, 1, 7, 8]},
            {'searchable': false, 'targets': [0, 1, 3, 5, 7, 8]}
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
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]'
            });
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
            row.child(format_order(row.data())).show();
            tr.addClass('shown');
        }
    });
};

$(document).ready(function() {
    init_datatables();
});
