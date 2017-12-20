var get_querystring = function() {
    var vars = {}, hash;
    if (window.location.href.indexOf('?') >= 0) {
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars[hash[0]] = hash[1];
        }
    }
    return vars;
};
var set_querystring = function(vars) {
    var hashes = [];
    for (var i in vars) {
        hashes.push(i + '=' + vars[i]);
    }
    return '?' + hashes.join('&');
};

var set_pagination = function() {
    var query = get_querystring();
    var url = window.location.pathname;
    var max_page = parseInt($("ul.pagination").attr("data-content"));
    var page = 1;
    if ('page' in query) {
        page = parseInt(query['page']);
        if (page < 1 || page > max_page) {
            page = 1;
        }
    }

    query['page'] = 1;
    $("li.first-page a").attr('href', url + set_querystring(query));
    query['page'] = max_page;
    $("li.last-page a").attr('href', url + set_querystring(query));

    if (page == 1) {
        $("li.previous-page").addClass('disabled');
        $("li.previous-page a").removeAttr('href');
    } else {
        query['page'] = page - 1;
        $("li.previous-page a").attr('href', url + set_querystring(query));
    }
    if (page == max_page) {
        $("li.next-page").addClass('disabled');
        $("li.next-page a").removeAttr('href');
    } else {
        query['page'] = page + 1;
        $("li.next-page a").attr('href', url + set_querystring(query));
    }

    $("li.page-number a").each(function() {
        page = parseInt($(this).text());
        query['page'] = page;
        $(this).attr('href', url + set_querystring(query));
    });
};

$(document).ready(function() {
    set_pagination();
});
