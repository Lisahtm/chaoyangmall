var get_button = function(client_id, classname, title, content) {
    return '<a class="' + classname + ' table_link client_button" data-field="' + client_id + '" ' +
        'data-toggle="confirmation" ' +
        'data-btn-ok-label="是" data-btn-ok-icon="glyphicon glyphicon-ok" data-btn-ok-class="btn-success" ' +
        'data-btn-cancel-label="否" data-btn-cancel-icon="glyphicon glyphicon-remove" data-btn-cancel-class="btn-danger" ' +
        'data-title="' + title + '" data-singleton="true" data-popout="true" ' +
        'data-placement="left">' + content + '</a>';
    // var c = ' onclick="null" ';
    // return '<a class="' + classname + ' table_link client_button" data-field="' + client_id + '" ' 
    // + c + 'data-title="' + title + '">' + content + '</a>';
};

var set_datatable = function() {
    // $('a.client_button').click(function() { 
    /* Solve the problem of click (in datatable) not working on iOS*/
    $('#dataTables').on('click','a.client_button',function() {
        var client_id = $(this).attr('data-field');
        var classes = $(this).attr('class');
        var state = classes.indexOf('accept') >= 0 ? 1 : -1;
        var btn = $(this);
        btn.unbind('click');
        $.ajax({
            "type": "POST",
            "url": '{$Think.config.prefix}/Admin/Activity/submit',
            "data": {
                'id': client_id,
                'state': state,
                'vendor': GetQueryString("vendor")
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

function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
var init_datatables = function() {   
    var config = {
        iDisplayLength: 50,
        lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "所有"]],
        order: [1, 'asc'],
        pagingType: 'full_numbers',
        processing: true,
        serverSide: true,
        ajax: {
            'url': '/chaoyangmall/Admin/Activity/get_activity',
            'type': 'POST',
            'data': function(d) {
                return $.extend({}, d, {
                    'vendor': GetQueryString("vendor")
                });
            }
        },
        columns: [
            {
                'data': 'empty',
                'className': 'control'
            },
            {'data': 'no'},
            {
                'data': 'title',
            },
            {'data': 'content'},
            {
                'data': 'id',
                'render': function(data, type, row, meta) {
                    return '<a href="/Admin/Activity/delete.html?activity_id=' + row['id'] + '">删除</a>'; 
                }
            }
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0,1,2,3,4]},
            {'searchable': false, 'targets': [0,1,4]}
        ],
        language: {
            'url': '/chaoyangmall/Public/js/Admin/datatables-Chinese.json'
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
    $('#dataTables').DataTable(config);
};

$(document).ready(function() {
    init_datatables();
});
