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
            'url': '/Admin/Company/get_companylist',
            'type': 'POST'
        },
        columns: [
            {
                'data': 'empty',
                'className': 'control'
            },
            {'data': 'no'},
            {
                'data': 'name',
                 'render': function(data, type, row, meta) {
                    return '<a href="/Admin/Company/edit.html?id=' + row['id'] +'">'+data+'</a>&nbsp;';
                }
                
            },
            {'data': 'content'},
            {
                'data': 'id',
                'render': function(data, type, row, meta) {
                    return '<a href="/Admin/Company/delete.html?id=' + row['id'] +'">删除</a>'; 
                }
            }
        ],
        columnDefs: [
            {'orderable': false, 'targets': [0,1,2,3,4]},
            {'searchable': false, 'targets': [0,1,4]}
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
        }
    };
    $('#dataTables').DataTable(config);
};

$(document).ready(function() {
    init_datatables();
});
