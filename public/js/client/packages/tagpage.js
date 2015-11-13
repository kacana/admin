var tagpagePackage = {
    tagpage:{
        init: function(){
            Kacana.tagpage.loadProduct();
        },

        loadProduct: function(){
            var is_busy = false;
            var page = 1;
            var stopped = false;
            $(window).scroll(function(){
                $tagId = $("#tag-id").val();
                $element = $("#content");
                $loading = $("#loading");

                if($(window).scrollTop() + $(window).height() >= $element.height()){
                    //neu dang gui ajax thi ngung
                    if(is_busy == true){
                        return false;
                    }
                    //neu het du lieu thi ngung
                    if(stopped == true){
                        return false;
                    }
                    //thiet lap dang gui ajax
                    is_busy = true;
                    //tang so trang len
                    page++;
                    //hien thi loading
                    $loading.removeClass('hidden');
                    //gui ajax
                    var callBack = function(data) {
                        $element.append(data);
                        Kacana.homepage.init();
                        $loading.addClass('hidden');
                        is_busy = false;
                    };
                    var errorCallBack = function(data){};
                    Kacana.ajax.tagpage.loadProduct($tagId, page, callBack, errorCallBack);
                    return false;
                }
            })
        }
    }
};

$.extend(true, Kacana, tagpagePackage);