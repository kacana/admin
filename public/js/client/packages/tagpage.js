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
            $(".as-filter-option").click(function(){
                hash = window.location.hash.replace("#", "");
                var callBack = function(data) {
                    $element.html(data);
                    Kacana.homepage.init();
                };
                var errorCallBack = function(data){};
                Kacana.ajax.tagpage.loadFilter(hash, callBack, errorCallBack);
                return false;
            });
        }
    }
};

$.extend(true, Kacana, tagpagePackage);