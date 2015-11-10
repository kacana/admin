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
        getPopoverPlacement: function(pop, dom_el){
                var width = window.innerWidth;
                if (width<500) return 'bottom';
                var left_pos = $(dom_el).offset().left;
                if (width - left_pos > 400) return 'right';
                return 'left';
        },
        initPopover: function(id, data){
            $('#_btn_'+id).popover({
                html: 'true',
                placement: Kacana.homepage.getPopoverPlacement,
                content : data
            }).popover('show');
        },
        showPopupRequest: function(id){
            $('.btn-advise').popover('destroy');
            var callBack = function(data){
                $(window).on('resize', function(){
                    $('.btn-advise').popover('destroy');
                    Kacana.homepage.initPopover(id, data);
                    return false;
                })
                Kacana.homepage.initPopover(id, data);
                return false;
            };
            var errorCallBack = function(){};
            Kacana.ajax.homepage.showPopupRequest(id, callBack, errorCallBack);
        },
        sendRequest: function(id){
            $("#btn-create").attr('disabled', true);
            var form_data = $("#form-create-request-info").serialize();
            var callBack = function(data) {
                data = JSON.parse(data);
                if(data.status =='ok'){
                    $('#_btn_'+id).popover('destroy').popover({content:"Yêu cầu của bạn đã được gửi thành công!"});
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