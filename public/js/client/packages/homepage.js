var homepagePackage = {
    homepage:{
        homePageId: $('#homepage'),
        init: function(){
            Kacana.homepage.reSizeProductImage();
        },
        reSizeProductImage: function(){
            Kacana.homepage.homePageId.find('.product-item').each(function(){
                var imageProduct = $(this).find('.product-image img');
                    var height = imageProduct.prop('naturalHeight');
                    var width = imageProduct.prop('naturalWidth');
                    var widthParent = imageProduct.parents('.product-image').width();
                    var heightParent = imageProduct.parents('.product-image').height();

                    var tempHeight = height * ( widthParent/width );

                    if(tempHeight > heightParent)
                    {
                        imageProduct.css('height', '100%');
                    }
                    else
                        imageProduct.css('width', '100%');
                });
        },
        showPopupRequest: function(id){
            var callBack = function(data){
                $("#popupRequest").html(data);
                $("#popupRequest").modal('show');
            };
            var errorCallBack = function(){};
            Kacana.ajax.homepage.showPopupRequest(id, callBack, errorCallBack);
        },
        sendRequest: function(){
            $("#btn-create").attr('disabled', true);
            var form_data = $("#form-create-request-info").serialize();
            var callBack = function(data) {
                $("#popupRequest").modal('hide');
                $("#showNotice").modal('show');
                data = JSON.parse(data);
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
                if(typeof(json_result['message'])!=''){
                    $("#error-message").html(json_result['message']);
                }
                $("#btn-create").attr('disabled', false);
            };
            Kacana.ajax.homepage.sendRequest(form_data, callBack, errorCallBack);
        }
    }

};

$.extend(true, Kacana, homepagePackage);