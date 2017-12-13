var set_deliver_button = function() {
    $("a.deliver_button").click(function() {
        var order_id = $(this).attr('data-field');
        var btn = $(this);
        btn.unbind('click');
        $.ajax({
            "type": "POST",
            "url": "/Admin/Order/submit_delivery",
            "data": {
                'id': order_id
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {
                    var state_html = '已发货<br><a class="print_delivery" href="/Admin/Order/print_delivery?serial_id=' + res['serial_id'] + '">生成发货单</a>';
                    btn.parents('td').html(state_html);
                } else {
                    window.location.reload();
                }
            },
            "error": function(xhr, error, thrown) {
                btn.bind('click');
            }
        });
    })
};

$(document).ready(function() {
    set_deliver_button();
});
