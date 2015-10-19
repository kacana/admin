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
        }
    }
};

$.extend(true, Kacana, homepagePackage);