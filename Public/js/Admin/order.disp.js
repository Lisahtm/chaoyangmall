var set_order_nav = function() {
    var query = get_querystring();
    var state = 0;
    if ('state' in query) {
        state = parseInt(query['state']);
        state = state + 1;
        if (state > 6 || state < 0) { state = 0; }        
    }
    $("ul#order_nav li").removeClass('active');
    $("ul#order_nav li:eq('" + state + "')").addClass('active');

    $("input#show_cancelled").change(function() {
        if ($(this).get(0).checked) {
            $("div.cancelled_order").hide('normal');
        } else {
            $("div.cancelled_order").show('normal');
        }
    });
};

$(document).ready(function() {
    set_order_nav();
});
