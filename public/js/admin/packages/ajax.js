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
         *          FUNCTION AJAX FOR USER MANAGEMENT
         *
         * ***************************************************************************/
        user:{
            showFormCreateUser: function(callBack,errorCallBack){
                Kacana.ajax.init('/user/showCreateForm', '', 'get', '', callBack, errorCallBack, []);
            },
            createUser: function(otherData, dataPost, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/user/create?'+otherData, 'post', dataPost, callBack, errorCallBack);
            },
            removeUser: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/user/remove/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            setStatus: function(id, status, callBack, errorCallBack){
                Kacana.ajax.init('/user/setStatus/'+id+'/'+status, '', 'get', '', callBack, errorCallBack, []);
            }
        },
        /*****************************************************************************
         *
         *          FUNCTION AJAX FOR BRANCH MANAGEMENT
         *
         * ***************************************************************************/
        branch:{
            createBranch: function(otherData, dataPost, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/branch/createBranch?'+otherData, 'post',dataPost, callBack, errorCallBack);
            },
            showEditBranchForm: function(idBranch, callBack, errorCallBack){
                Kacana.ajax.init('/branch/showEditFormBranch/'+idBranch,'', 'get', '', callBack, errorCallBack, []);
            },
            editBranch: function(otherData, dataPost, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/branch/editBranch?'+ otherData, 'post', dataPost, callBack, errorCallBack);
            },
            setStatusBranch: function(id, status, callBack, errorCallBack){
                Kacana.ajax.init('/branch/setStatusBranch/'+id+'/'+status,'', 'get', '', callBack, errorCallBack, []);
            },
            removeBranch: function(id,callBack, errorCallBack){
                Kacana.ajax.init('/branch/removeBranch/'+id, '', 'get', '', callBack, errorCallBack, []);
            }
        },
        /*****************************************************************************
         *
         *          FUNCTION AJAX FOR PRODUCT MANAGEMENT
         *
         * ***************************************************************************/
        product: {
            removeProduct: function(id,callBack, errorCallBack){
                Kacana.ajax.init('/product/removeProduct/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            setStatus: function(id, status, callBack, errorCallBack){
                Kacana.ajax.init('/product/setStatus/'+id+'/'+status, '', 'get', '', callBack, errorCallBack, []);
            }
        },
        /*****************************************************************************
         *
         *          FUNCTION AJAX FOR TAG MANAGEMENT
         *
         * ***************************************************************************/
        tag: {
            showCreateForm: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/tag/showFormCreate/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            createTag: function(data, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/tag/createTag?'+data, 'post', '', callBack, errorCallBack);
            },
            showEditForm: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/tag/showEditFormTag/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            editTag: function(data, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/tag/editTag?'+data, 'post', '', callBack, errorCallBack);
            },
            removeTag: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/tag/removeTag/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            setType: function(id, type, callBack, errorCallBack){
                Kacana.ajax.init('/tag/setType/'+id+'/'+type,'json', 'get','',callBack, errorCallBack, []);
            }
        },
        /*****************************************************************************
         *
         *          FUNCTION AJAX FOR USER ADDRESS MANAGEMENT
         *
         * ***************************************************************************/
        userAddress:{
            showFormEdit: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/user/showFormEditUserAddress/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            edit: function(data, callBack, errorCallBack){
                Kacana.ajax.initFileUpload('/user/editUserAddress?'+data, 'post', '', callBack, errorCallBack);
            },
            changeCity: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/user/showListWards/'+id, '', 'get', '', callBack, errorCallBack, []);
            }
        },
        /*****************************************************************************
         *
         *          FUNCTION AJAX FOR ORDER MANAGEMENT
         *
         * ***************************************************************************/
        order:{
            changeCity: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/user/showListWards/'+id, '', 'get', '', callBack, errorCallBack, []);
            },
            deleteOrderDetail: function(id, callBack, errorCallBack){
                Kacana.ajax.init('/order/deleteOrderDetail/'+id,'', 'get', '', callBack, errorCallBack, []);
            }
        }
     }
};

$.extend(true, Kacana, ajaxPackage);