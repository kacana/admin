var cartPackage = {

    cart: {
        classQty: $(".qty"),
        classRemove: $('.remove-cart'),
        init: function () {
            Kacana.cart.updateCart();
            Kacana.cart.removeCart();
            Kacana.cart.showFormUser();
        },
        removeCart: function(){
            Kacana.cart.classRemove.click(function(){
                id = $(this).attr('data-id');
                var callBack = function(data){
                    window.location.reload();
                }
                var errorCallBack = function(data){}
                Kacana.ajax.cart.removeCart(id, callBack, errorCallBack);
            })
        },
        showFormUser: function(){
            $("#proceed").click(function(){
                $(this).hide();
                $("#user-info").show();
            })
        },
        addToCart: function(){
            $("#add-cart-btn").attr('disabled', true);
            var qty_arr = [];
            $('#oi_product_color ul li').each(function(index){
                qty = $(this).find(".product_qty").val();
                if(qty >0){
                    col_id = $(this).find(".product_qty").attr('data-id');
                    value = col_id + "q" + qty;
                    qty_arr.push(value);
                }
            });
            $("#qty").val(qty_arr);

            var other_data = $("#form-cart").serialize();
            var callBack = function(data){
                data = JSON.parse(data);
                if(data.status ==='ok'){
                    $(".has-error").html('');
                    window.location.href='/cart/showCart';
                }else{
                    $(".has-error").html(data.message);
                    $("#add-cart-btn").attr('disabled', false);
                }
            }
            var errorCallBack = function(data){
                $("#add-cart-btn").attr('disabled', false);
            }
            Kacana.ajax.cart.addToCart(other_data, callBack, errorCallBack);
        },
        updateCart: function(){
            Kacana.cart.classQty.click(function(){
                pid = $(this).attr('data-id');
                qty = $(this).val();
                var callBack = function(data){
                    $(".amount-"+pid).html(data.subtotal);
                    $(".total-amount").html(data.total);
                };
                var errorCallBack = function(data){};
                Kacana.ajax.cart.updateCart(pid, qty, callBack, errorCallBack);
            })
        },
        changeCity: function(){
            var id = $("#city_id").val();
            var token = $("input[name='_token']").val();
            var callBack = function(data){
                $("#ward-area").html(data);
            };
            var errorCallback = function(data){};
            Kacana.ajax.cart.changeCity('id='+id+"&_token="+token, callBack, errorCallback);
        },
        processCart: function(){
            $("#process").attr('disabled', true);
            $("#ward_id").val($("#ward").val());
            var other_data = $("#form-user-info").serialize();
            var callBack = function(data){
                json_result = JSON.parse(data);
                if(json_result.status==='ok'){
                    window.location.href= '/cart/don-dat-hang/'+json_result.id;
                }
            };
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
                if(typeof(json_result['city_id'])!=''){
                    $("#error-city").html(json_result['city_id']);
                }
                if(typeof(json_result['ward_id'])!=''){
                    $("#error-ward").html(json_result['ward_id']);
                }
                $("#process").attr('disabled', false);
            };
            Kacana.ajax.cart.processCart(other_data, callBack, errorCallBack);
        }
    }

};

$.extend(true, Kacana, cartPackage);