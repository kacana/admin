var productdetailPackage = {
    productdetail:{
        adviseBtnClass: $('.btn-advise'),
        actionSendBtn: $("#btn-create"),
        init: function(){
            Kacana.productdetail.showPopupRequest();
            Kacana.productdetail.closeAdvisePopup();
        },
        getPopoverPlacement: function(pop, dom_el){
            var width = window.innerWidth;
            if (width<500) return 'bottom';
            var left_pos = $(dom_el).offset().left;
            if (width - left_pos > 400) return 'right';
            return 'left';
        },
        initPopover: function(id, data){
            $('#'+id).popover({
                html: 'true',
                title: 'Tư vấn <a href="#" class="close" data-dismiss="alert">&times;</a>',
                placement: Kacana.productdetail.getPopoverPlacement,
                content : data
            }).popover('show');
        },
        showPopupRequest: function(){
            Kacana.productdetail.adviseBtnClass.click(function(e){
                $(this).attr('disabled', true);
                var id = $(this).attr('id');
                var callBack = function(data){
                    $(window).on('resize', function(){
                        Kacana.productdetail.initPopover(id, data);
                        return false;
                    })
                    Kacana.productdetail.initPopover(id, data);
                };
                var errorCallBack = function(){};
                Kacana.ajax.homepage.showPopupRequest(id, callBack, errorCallBack);
            })
        },
        sendRequest: function(id){
            $(this).attr('disabled', true);
            var form_data = $("#form-create-request-info").serialize();
            var callBack = function(data) {
                data = JSON.parse(data);
                if(data.status =='ok'){
                    $('#'+id).popover('destroy').popover({content:"Yêu cầu của bạn đã được gửi thành công!"});
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
        },
        closeAdvisePopup: function(){
            $(document).on("click", ".popover .close" , function(){
                $(this).parents(".popover").popover('hide');
            });
            $('body').on('click', function (e) {
                Kacana.productdetail.adviseBtnClass.each(function () {
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                        $(this).popover('hide');
                    }
                });
                Kacana.productdetail.adviseBtnClass.attr('disabled', false);
            });
        }
    }

};

$.extend(true, Kacana, productdetailPackage);