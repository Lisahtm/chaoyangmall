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
            $("button#submit_purchase").removeAttr("disabled");
            $("input.not_null").removeClass("has-error");
        } else {
            $("button#submit_purchase").attr("disabled", "disabled");
            $("input.not_null").each(function() {
                if ($(this).val().length == 0) {
                    $(this).addClass("has-error");
                } else {
                    $(this).removeClass("has-error");
                }
            });
        }
    });

    $("input.not_null").change();    
};

var set_stock_buttons = function() {
    $('button#add_line').click(function() {
        var num=$("#dataTables tr").size();        
        var lastTr = $('#dataTables tr:last');
        var wholesaler = lastTr.find("input#wholesaler").val();
        var currentDate = new Date();        
        var trHtml = '<tr>'
                        + '<td><p>' + num + '</p><button type="button" id="del_line" class="btn btn-info btn-intable">删</button>'
                        + '<input class="form-control" id="product_id" name="product_id[]" placeholder="ID" type="hidden"></td>'
                        + '<td><input class="form-control not_null" id="barcode" name="barcode[]" placeholder="条码" type="text">'
                        + '<p></p><input class="form-control not_null" id="name" name="name[]" placeholder="名称" type="text"></td>'
                        + '<td><input class="form-control not_null" id="purchase_quantity" name="purchase_quantity[]" placeholder="数量" type="number" min="0">'
                        + '<p></p><input class="form-control not_null" id="specification" name="specification[]" placeholder="规格" type="number" min="0" step="1" readonly="readonly"></td>'
                        + '<td><input class="form-control not_null" id="total_amount" name="total_amount[]" placeholder="金额" type="number" min="0" step="0.01" >'
                        + '<p></p><input class="form-control not_null" id="purchase_price" name="purchase_price[]" placeholder="进价" type="number" min="0" step="0.01" ></td>'
                        + '<td><input class="form-control not_null" id="repertory" name="repertory[]" placeholder="现有库存" type="number" readonly="readonly">'
                        + '<p></p><input class="form-control not_null" id="purchase_date" rel="datepicker" data-date-format="yyyy-mm-dd" name="purchase_date[]" placeholder="进货日期" type="text" value="' + currentDate.toLocaleDateString() + '"></td>'
                        + '<td><input class="form-control not_null" id="package_price" name="package_price[]" placeholder="整包价" type="number" min="0" step="0.01" readonly="readonly">'
                        + '<p></p><input class="form-control not_null" id="single_price" name="single_price[]" placeholder="单包价" type="number" min="0" step="0.01"  readonly="readonly"></td>'
                        + '<td colspan="2"><input class="form-control" id="wholesaler" name="wholesaler[]" placeholder="供货商" type="text" value="' + wholesaler + '"'
                        + '<p></p><input class="form-control" id="comment" name="comment[]" placeholder="备注" type="text"></td>'
                    + '</tr>';
        // $tr.after(trHtml);
        $("#dataTables").append(trHtml);
        set_datatable();
        set_input_check();
    }); 
}

var set_datatable = function() {
    $("#dataTables button#del_line").click(function() {     
        if ($("#dataTables tr").size() > 2) {   
            var t = $(this).parent().parent("tr").remove();//移除选中的行
            // set_datatable();
            set_input_check();
            // set_stock_buttons();
        }
    });

    $("input#total_amount").change(function() {
        var amount = $(this).val();
        var thisTr = $(this).parent().parent();
        var quantity = thisTr.find("input#purchase_quantity").val();
        if (quantity != '' && quantity != 0) {
            thisTr.find("input#purchase_price").val((amount/quantity).toFixed(2));
        }

        var sum = 0;
        $("input#total_amount").each(function() {
            sum += parseFloat($(this).val());                        
        });
        $("span#current_sum").text(sum);
    });
    $("input#purchase_quantity").change(function() {
        var quantity = $(this).val();
        var thisTr = $(this).parent().parent();
        var amount = thisTr.find("input#total_amount").val();
        if (amount != '') {
            thisTr.find("input#purchase_price").val((amount/quantity).toFixed(2));
        }
    });
    
    $("input#barcode").autocomplete({        
        serviceUrl: 'autocomplete?field=barcode',
        
        onSelect: function (suggestion) {
            var barcode = suggestion.value;
            var name = suggestion.data;
            var thisTr = $(this).parent().parent();
            $.ajax({
                "type": "POST",
                "url": "/Admin/Stock/fill",
                "data": {
                    'barcode': barcode,
                    'name': name
                },
                "dataType": "json",
                "success": function(res) {                         
                    thisTr.find("input#product_id").val(res['id']);
                    thisTr.find("input#name").val(res['name']);
                    thisTr.find("input#specification").val(res['specification']);
                    thisTr.find("input#repertory").val(res['repertory']);
                    thisTr.find("input#package_price").val(res['package_price']);
                    thisTr.find("input#single_price").val(res['single_price']);
                },
                "error": function(xhr, error, thrown) {
                    
                }
            });
        }
    });

    $("input#name").autocomplete({        
        serviceUrl: 'autocomplete?field=name',
        
        onSelect: function (suggestion) {
            var name = suggestion.value;
            var barcode = suggestion.data;
            var thisTr = $(this).parent().parent();
            $.ajax({
                "type": "POST",
                "url": "/Admin/Stock/fill",
                "data": {
                    'barcode': barcode,
                    'name': name
                },
                "dataType": "json",
                "success": function(res) {                    
                    thisTr.find("input#product_id").val(res['id']);
                    thisTr.find("input#barcode").val(res['barcode']);
                    thisTr.find("input#specification").val(res['specification']);
                    thisTr.find("input#repertory").val(res['repertory']);
                    thisTr.find("input#package_price").val(res['package_price']);
                    thisTr.find("input#single_price").val(res['single_price']);                    
                },
                "error": function(xhr, error, thrown) {
                    
                }
            });
        }
    });
}

$(document).ready(function() {
    set_datatable();
    set_input_check();
    set_stock_buttons();
    // set_order_buttons();
});