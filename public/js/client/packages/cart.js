var cartPackage = {
    cart: {
        init: function () {

        },
        removeCart: function(id){
            var callBack = function(data){
                window.location.reload();
            }
            var errorCallBack = function(data){}
            Kacana.ajax.cart.removeCart(id, callBack, errorCallBack);
        },
        processCart: function(){
            $("#process").attr('disabled', true);
            var other_data = $("#form-user-info").serialize();
            var callBack = function(data){
                json_result = JSON.parse(data);
                console.log(json_result);
                if(json_result.status==='ok'){
                    window.location.href= '/cart/don-dat-hang/'+json_result.id;
                }
            }
            var errorCallBack = function(data){
                json_result = JSON.parse(data.responseText);

                if(typeof(json_result['name'])!=''){
                    $("#error-name").html(json_result['name']);
                }
                if(typeof(json_result['email'])!=''){
                    $("#error-email").html(json_result['email']);
                }
                if(typeof(json_result['phone'])!=''){
                    $("#error-phone").html(json_result['phone']);
                }
                if(typeof(json_result['name_2'])!=''){
                    $("#error-name_2").html(json_result['name_2']);
                }
                if(typeof(json_result['phone_2'])!=''){
                    $("#error-phone_2").html(json_result['phone_2']);
                }
                if(typeof(json_result['street'])!=''){
                    $("#error-street").html(json_result['street']);
                }
                if(typeof(json_result['city'])!=''){
                    $("#error-city").html(json_result['city']);
                }
                if(typeof(json_result['ward'])!=''){
                    $("#error-ward").html(json_result['ward']);
                }
                $("#process").attr('disabled', false);
            };
            Kacana.ajax.cart.processCart(other_data, callBack, errorCallBack);
        }
    }

};

$.extend(true, Kacana, cartPackage);