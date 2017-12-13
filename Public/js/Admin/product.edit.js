var get_categories = function() {
    $.ajax({
        "type": 'GET',
        "url": "/Admin/Product/get_categories",
        "dataType": "json",
        "success": function (res) {
            var category_info = {};
            var category_selector = $('select#category');
            var subcategory_selector = $('select#subcategory');

            category_selector.empty();
            for (var i in res) {
                category_selector.append('<option>' + i + '</option>');
                category_info[i] = '';
                for (var j in res[i]) {
                    category_info[i] += ('<option value="' + j + '">' + res[i][j] + '</option>');
                }
            }
            category_selector.change(function() {
                subcategory_selector.html(category_info[category_selector.val()]);
            });

            if (category_selector.attr('data-content')) {
                category_selector.find('option:contains("' + category_selector.attr('data-content') + '")').attr("selected", "selected");
            }
            category_selector.trigger('change');
            if (subcategory_selector.attr('data-content')) {
                subcategory_selector.find('option:contains("' + subcategory_selector.attr('data-content') + '")').attr("selected", "selected");
            }

            var service_selector = $('select#service');
            if (service_selector.attr('data-content')) {
                service_selector.find('option:contains("' + service_selector.attr('data-content') + '")').attr("selected", "selected");
            }
        }
    });
};

$(document).ready(function() {
    get_categories();
});
