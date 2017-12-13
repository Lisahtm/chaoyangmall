function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
var set_button = function() {
    $('button#resetpwd').click(function() {  
        var client_id = parseInt($("input#id").val());
        $.ajax({
            "type": 'POST',
            "url": "/Admin/Client/resetpwd",
            "data": {
                'client_id': client_id,
                'vendor':GetQueryString("vendor")
            },
            "dataType": "json",
            "success": function(res) {
                if (res['code'] == 0) {                    
                    toastr.success(res['msg']);                    
                }
            },
            "error": function(xhr, error, thrown) {                
                toastr.error(res['msg']);
            }
        });        
    });
};


$(document).ready(function() {    
    set_button();
});
