var set_print_button = function() {
    $('button#print').click(function() { window.print(); });
    var query = get_querystring();
    var url = '/Admin/Order/';
    if ('from' in query) {
        url = url + query['from'] + '.html';
    } else {
        url += 'deliver.html';
    }
    $('button#return').click(function() {
        window.location.href = url;
    });
};

$(document).ready(function() {
    set_print_button();
});
