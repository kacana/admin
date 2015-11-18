var tagpagePackage = {
    tagpage:{
        init: function(){
            Kacana.tagpage.loadProduct();
            Kacana.tagpage.showFilter();
            Kacana.tagpage.loadFilter();
        },

        loadProduct: function(){
            var is_busy = false;
            var page = 1;
            var stopped = false;
            $(window).scroll(function(){
                $tagId = $("#tag-id").val();
                $colorId = $("#color-id").val();
                $brandId = $("#brand-id").val();
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
                    Kacana.ajax.tagpage.loadProduct($tagId, $colorId, $brandId, page, callBack, errorCallBack);
                    return false;
                }
            })
        },
        showFilter:function(){
            $(".as-filter-button").click(function(){
                if($(this).attr('aria-expanded')=='false'){
                    $("#as-search-filters").removeClass('as-filter-animation');
                    $("#as-search-filters").css({"position":"relative"});
                    $(".as-search-filters").attr('aria-hidden', false);
                    $("#content").addClass('col-sm-9');
                }else{
                    $("#as-search-filters").addClass('as-filter-animation');
                    $("#as-search-filters").css({"position":"fixed"});
                    $(".as-search-filters").attr('aria-hidden', true);
                    $("#content").removeClass('col-sm-9');
                }
            });

            $(".as-search-accordion-header").on('click',function(){
                if($(this).hasClass("as-accordion-isexpanded")){
                    $(this).removeClass('as-accordion-isexpanded');
                    $(this).next().addClass('ase-materializer-gone ase-materializer-hide').removeClass("ase-materializer-show");
                }else{
                    $(this).addClass('as-accordion-isexpanded');
                    $(this).next().addClass('ase-materializer-show').removeClass("ase-materializer-gone").removeClass("ase-materializer-hide");
                }
            })

            $(".as-search-filter-child2").on('click', function(){
                if($("#as-seach-filter-childs2").hasClass('ase-materializer-gone')){
                    $("#as-seach-filter-childs2").removeClass('ase-materializer-gone');
                }else{
                    $("#as-seach-filter-childs2").addClass('ase-materializer-gone');
                }
            })
        },
        loadFilter: function(){
            $.urlParam = function(name, url){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
                if($.isArray(results)){
                    return results[1];
                }else{
                    return 0;
                }
            },
            $(".as-filter-option").click(function(e){
                $(this).parent('.as-filter-item').addClass('as-filter-active current');
                e.preventDefault();
                var pageUrl = $(this).attr('href');
                var dataPost = '';

                var tag = $.urlParam('tag', pageUrl);
                var color = $.urlParam('color', pageUrl);
                var brand = $.urlParam('brand', pageUrl);

                if(color == 0){
                    color = $.urlParam('color', location.href);
                }

                if(brand == 0){
                    brand = $.urlParam('brand', location.href);
                }

                if(tag == 0){
                    tag = $.urlParam('tag', location.href);
                }
                if(tag!=0 && pageUrl.indexOf('tag')==-1){
                    pageUrl += '&tag='+tag;
                }

                if(color!=0 && pageUrl.indexOf('color')==-1){
                    pageUrl += '&color='+color;
                }
                if(brand!=0 && pageUrl.indexOf('brand')==-1){
                    pageUrl += '&brand='+brand;
                }

                $("#color-id").val(color);
                $("#brand-id").val(brand);
                $("#tag-id").val(tag);
                dataPost += 'cateId='+tag+'&color='+color+"&brand="+brand;

                var callBack = function(data) {
                    $("#content").html(data);
                    Kacana.homepage.init();
                };
                var errorCallBack = function(data){};
                Kacana.ajax.tagpage.loadFilter(dataPost, callBack, errorCallBack);

                if(pageUrl != window.location){
                    window.history.pushState({path:pageUrl}, '',pageUrl);
                }
                return false;
            });
        }
    }
};

$.extend(true, Kacana, tagpagePackage);