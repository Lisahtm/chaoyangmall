var get_categories = function(callback) {
    $.ajax({
        "type": 'GET',
        "url": "/Admin/Product/get_categories",
        "dataType": "json",
        "success": function (res) {
            var category_info = {};
            var category_selector = $('select#category');
            var subcategory_selector = $('select#subcategory');

            category_selector.empty();
            category_selector.append('<option value="all">所有</option>');
            category_info['all'] = '<option value="all">所有</option>';
            for (var i in res) {
                category_selector.append('<option>' + i + '</option>');
                category_info[i] = '<option value="all">所有</option>';
                for (var j in res[i]) {
                    category_info[i] += ('<option value="' + res[i][j] + '">' + res[i][j] + '</option>');
                }
            }

            category_selector.change(function() {
                subcategory_selector.html(category_info[category_selector.val()]);
                if ($.fn.DataTable.isDataTable('#dataTables')) {
                    $('#dataTables').DataTable().ajax.reload();
                }
            });
            subcategory_selector.change(function() {
                if ($.fn.DataTable.isDataTable('#dataTables')) {
                    $('#dataTables').DataTable().ajax.reload();
                }
            });

            category_selector.trigger('change');
            callback();
        }
    });
};

var set_button = function() {
    $('button#delete_products').click(function() {
        if ($(this).attr('disabled')) { return; }
        var selected_products = [];
        $('input.product_selector').each(function() {
            if ($(this).get(0).checked) {
                selected_products.push(parseInt($(this).attr('name')));
            }
        });
        $.ajax({
            "type": 'POST',
            "url": "/Admin/Product/delete_products",
            "data": {
                'products': selected_products
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {
                    $('#dataTables').DataTable().ajax.reload();
                } else {
                    window.location.reload();
                }
            },
            "error": function(xhr, error, thrown) {
                window.location.reload();
            }
        });
    });
};

var update_button = function() {
    var any_selected = false;
    var all_selected = true;
    $('input.product_selector').each(function() {
        any_selected |= $(this).get(0).checked;
        all_selected &= $(this).get(0).checked;
    });

    $('input.all_selector').get(0).checked = all_selected;
    if (any_selected) {
        $('button#delete_products').removeAttr('disabled');
    } else {
        $('button#delete_products').attr('disabled', 'disabled');
    }
};

var set_datatable = function() {
    $("input.product_selector").change(function() {
        update_button();
    });

    $("input.all_selector").change(function() {
        if ($(this).get(0).checked) {
            $("input.product_selector").each(function() {
                $(this).get(0).checked = true;
            })
        } else {
            $("input.product_selector").each(function() {
                $(this).get(0).checked = false;
            })
        }
        update_button();
    });

    $('#dataTables').on('click','a.sticky_button',function() {
    // $('a.sticky_button').click(function() { 
        var product_id = $(this).attr('data-field');
        var classes = $(this).attr('class');
        var sticky = classes.indexOf('accept') >= 0 ? 1 : -1;
        var btn = $(this);
        btn.unbind('click');
        $.ajax({
            "type": "POST",
            "url": "/Admin/Product/sticky",
            "data": {
                'id': product_id,
                'sticky': sticky
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {
                    $('#dataTables').DataTable().ajax.reload();
                } else {
                    $('#dataTables').DataTable().ajax.reload();
                }
            },
            "error": function(xhr, error, thrown) {
                btn.bind('click');
            }
        });
    });

    $('#dataTables').on('click','a.onsale_button',function() {
    // $('a.sticky_button').click(function() { 
        var product_id = $(this).attr('data-field');
        var classes = $(this).attr('class');
        var on_sale = classes.indexOf('accept') >= 0 ? 1 : -1;
        var btn = $(this);
        btn.unbind('click');
        $.ajax({
            "type": "POST",
            "url": "/Admin/Product/onsale",
            "data": {
                'id': product_id,
                'on_sale': on_sale
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {
                    $('#dataTables').DataTable().ajax.reload();
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

var get_button = function(product_id, classname, title, content, field) {
    // return '<a class="' + classname + ' table_link sticky_button" data-field="' + product_id + '" ' +
    //     'data-toggle="confirmation" ' +
    //     'data-btn-ok-label="是" data-btn-ok-icon="glyphicon glyphicon-ok" data-btn-ok-class="btn-success" ' +
    //     'data-btn-cancel-label="否" data-btn-cancel-icon="glyphicon glyphicon-remove" data-btn-cancel-class="btn-danger" ' +
    //     'data-title="' + title + '" data-singleton="true" data-popout="true" ' +
    //     'data-placement="left">' + content + '</a>';
    return title + ' <a class="' + classname + ' table_link ' + field + '" data-field="' + product_id + '" ' 
    + 'data-title="' + title + '">'+ content + '</a>';
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
            'url': '/Admin/Product/get_products',
            'type': 'POST',
            'data': function(d) {
                var category = $('select#category').val();
                var subcategory = $('select#subcategory').val();
                return $.extend({}, d, {
                    'category': category,
                    'subcategory': subcategory
                });
            }
        },
        columns: [
            {
                'data': 'empty',
                'className': 'control rowlink-skip'
            },
            {
                'data': 'id',
                'className': 'rowlink-skip',
                'render': function(data, type, row, meta) {
                    return "<input type='checkbox' class='product_selector' name='" + data + "_selector' />";
                    // return row['no'];
                }
            },
            {
                'data': 'name',
                'className': 'product_name',
                'width': '20%',
                'render': function(data, type, row, meta) {
                    return '<a href="/Admin/Product/edit.html?product_id=' + row['id'] + '">' + data + '</a>';
                }
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
            {'data': 'purchase_step'},
            {
                'data': 'photo',
                'className': 'rowlink-skip',
                'render': function render(data, type, row, meta) {
                    if (data) {
                        return '<a href="#photoModal" data-toggle="modal" data-target="#photoModal" data-src="' + data + '">查看</a>';
                    } else {
                        return null;
                    }
                }
            },
            {
                'data': 'sticky',
                'className': 'rowlink-skip',
                'render': function render(data, type, row, meta) {                    
                    var id = parseInt(row['id']);
                    if (data > 0) {                        
                        return get_button(id, 'decline', '已顶', '取消','sticky_button');
                    } else {
                        return get_button(id, 'accept', '未顶', '置顶','sticky_button');                            
                    }
                }
            },
            {
                'data': 'on_sale',
                'className': 'rowlink-skip',
                'render': function render(data, type, row, meta) {                    
                    var id = parseInt(row['id']);
                    if (data > 0) {                        
                        return get_button(id, 'decline', '在促', '取消','onsale_button');
                    } else {
                        return get_button(id, 'accept', '未促', '促销','onsale_button');                            
                    }
                }
            },
            {
                'data': 'service',
                'render': function render(data, type, row, meta) {
                    if (data > 0) {
                        return service_prefix + data;
                    }
                }
            },
            {'data': 'category'},
            {'data': 'subcategory'},
            {'data': 'unit'},
            {
                'data': 'salable',
                'render': function render(data, type, row, meta) {
                    if (data > 0) {
                        return "是";
                    } else {
                        return "否";
                    }
                }
            },
            {
                'data': 'self_run',
                'render': function render(data, type, row, meta) {
                    if (data > 0) {
                        return "是";
                    } else {
                        return "否";
                    }
                }
            }
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0, 1]},
            {'searchable': false, 'targets': [0, 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17]}
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
            update_button();
        }
    };
    $('#dataTables').DataTable(config);
};

$(document).ready(function() {
    get_categories(init_datatables);
    set_button();

    $('#photoModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var photo_path = button.data('src');
        var modal = $(this);
        modal.find('img#photo').attr('src', photo_path);
    })
});
