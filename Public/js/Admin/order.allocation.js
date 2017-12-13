var input_check = function() {
    var all_complete = true;
    $("input.not_null").each(function() {
        if ($(this).val().length == 0) {
            all_complete = false;
        }
    });
    return all_complete;
};

var set_input_check = function() {
    $("input.not_null").change(function() {
        if (input_check()) {
            $("button#submit_allocation").removeAttr("disabled");
            $("input.not_null").parents("div.form-group").removeClass("has-error");
        } else {
            $("button#submit_order").attr("disabled", "disabled");
            $("input.not_null").each(function() {
                if ($(this).val().length == 0) {
                    $(this).parents("div.form-group").addClass("has-error");
                }
            });
        }
    });

    $("input.not_null").change();
};

var set_allocation_button = function() {
    $('button#submit_allocation').click(function(e) {
        e.preventDefault();
        var orders = [];
        $("input[name='id']").each(function() {
            orders.push(parseInt($(this).val()));
        });
        $.ajax({
            "type": 'POST',
            "url": "/Admin/Order/submit_allocation",
            "data": {
                'id': orders,
                'name': $("input[name='name']").val(),
                'comment': $("textarea[name='comment']").val()
            },
            "dataType": "json",
            "success": function(res) {
                $("div#notification").hide();
                $("div#notification").remove();
                if (res['code'] == 0) {
                    window.location.href = "/Admin/Order/print_allocation?serial_id=" + res['serial_id'];
                } else {
                    var notification = '<div id="notification" class="alert alert-danger alert-dismissable" style="display: none;">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                        '提交失败，原因：' + res['msg'] +
                        '</div>';
                    $("form").prepend(notification);
                    $("div#notification").toggle('normal');
                }
            }
        });
    });
};

var set_print_button = function() {
    $('button#print').click(function() { window.print(); });
    var query = get_querystring();
    var url = '/Admin/Order/';
    if ('from' in query) {
        url = url + query['from'] + '.html';
    } else {
        url += 'allocate.html';
    }
    $('button#return').click(function() {
        window.location.href = url;
    });
};

$(document).ready(function() {
    set_input_check();
    set_allocation_button();
    set_print_button();
});
