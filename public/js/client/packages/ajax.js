var ajaxPackage = {
    ajax: {
        init:function(url, dataType, type, dataPost, callBack, errorCallBack, options){

            //todo will re-change solution for option on this

            var cache = true;
            if(options.cache)
                cache = false;

            var async = true;
            if(options.async)
                async = false;

            $.ajax({
                url: url,
                dataType: dataType,
                type: type,
                cache: cache,
                async: async,
                data: dataPost
            }).done(function(data) {
                callBack(data);

            }).error(function() {
                errorCallBack();

            });

        },
        initFileUpload:function(url, type, dataPost, callBack, errorCallBack){
            $.ajax({
                url: url,
                type: type,
                data: dataPost,
                processData: false,
                contentType: false
            }).done(function(data)
            {
                callBack(data);

            }).fail(function(data, textStatus, errorThrown)
            {
                errorCallBack(data);

            });

        },
        checkStatus: function(url, callback){
            $.ajax(url, { type: 'HEAD'}).done(
                function (data, textStatus, jqXHR) {
                    callback(jqXHR.status);
                }
            );
        },
        /*****************************************************************************
         *
         *          FUNCTION AJAX FOR HOME PAGE
         *
         * ***************************************************************************/
        homepage:{
            showPopupRequest: function(id, callBack,errorCallBack){
                Kacana.ajax.init('/requestInfo/showPopupRequest/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            sendRequest: function(otherData, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/requestInfo/create?'+otherData, 'post','', callBack, errorCallBack);
            }
        },
        cart:{
            removeCart: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/cart/removeCart/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            processCart: function(otherData, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/cart/processCart?'+otherData, 'post', '', callBack, errorCallBack)
            }

        }
    }
};

$.extend(true, Kacana, ajaxPackage);