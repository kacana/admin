var orderPackage = {
    order:{
        init: function(){
            Kacana.order.lists();
        },
        lists: function(){
            var columns = ['id', 'name', 'phone', 'address', 'total', 'status', 'created', 'action'];
            var btable = Kacana.datatable.init('table', columns, '/order/getList');

            $("#search-form").on('submit', function(e){
                btable.search($("#search-name").val()).draw() ;
                e.preventDefault();
            })
        },

        removeProduct: function(idProduct){
            $('#confirm').modal('show');
            var callBack = function(data){
                window.location.reload();
            };
            var errorCallBack = function(){};
            $('#delete').click(function (e) {
                Kacana.ajax.product.removeProduct(idProduct, callBack, errorCallBack);
            });
        },
        setStatus: function(id, status){
            var callBack = function(data){
                window.location.reload();
            };
            var errorCallBack = function(){};
            Kacana.ajax.product.setStatus(id, status, callBack, errorCallBack);
        },
        branch:{
            init: function(){
                Kacana.product.branch.listBranch();
                Kacana.product.branch.showEditBranchForm();
                Kacana.product.branch.editBranch();
                Kacana.product.branch.showEditBranchForm();
                Kacana.product.branch.setStatusBranch();
            },
            listBranch: function(){
                var columns = ['id', 'name', 'image', 'status', 'created', 'updated', 'action']
                var btable = Kacana.datatable.init('table', columns, '/branch/getBranch');

                $("#search-form").on('submit', function(e){
                    btable.search($("#search-name").val()).draw() ;
                    e.preventDefault();
                })
            },
            createBranch: function(){
                $("#btn-create").attr('disabled', true);
                var form_data = new FormData();
                var file_image = $('#image').prop("files")[0];
                var other_data = $("#form-create-branch").serialize();
                form_data.append('image', file_image);
                var callBack = function(data){
                    window.location.reload();
                }
                var errorCallBack = function(data){
                    json_result = JSON.parse(data.responseText);
                    if(typeof(json_result['image'])!=''){
                        $("#error-image").html(json_result['image']);
                    }

                    if(typeof(json_result['name'])!=''){
                        $("#error-name").html(json_result['name']);
                    }
                    $("#btn-create").attr('disabled', false);
                };
                Kacana.ajax.branch.createBranch(other_data, form_data, callBack, errorCallBack);
            },
            showEditBranchForm: function(idBranch){
                var callBack = function(data){
                    $("#editModal").html(data);
                    $("#editModal").modal('show');
                };
                var errorCallBack = function(){};
                Kacana.ajax.branch.showEditBranchForm(idBranch, callBack, errorCallBack);
            },
            editBranch: function(){
                var form_data = new FormData();
                var file_image = $('#image').prop("files")[0];
                var other_data = $("#form-create-branch").serialize();
                form_data.append('image', file_image);
                var callBack = function(data){
                    window.location.reload();
                }
                var errorCallBack = function(data){
                    json_result = JSON.parse(data.responseText);
                    if(typeof(json_result['image'])!=''){
                        $("#error-image").html(json_result['image']);
                    }

                    if(typeof(json_result['name'])!=''){
                        $("#error-name").html(json_result['name']);
                    }
                    $("#btn-create").attr('disabled', false);
                };
                Kacana.ajax.branch.editBranch(other_data, form_data, callBack, errorCallBack);
            },
            setStatusBranch: function(id, status){
                var callBack = function(data){
                    window.location.reload();
                };
                var errorCallBack = function(){};
                Kacana.ajax.branch.setStatusBranch(id, status, callBack, errorCallBack);
            },
            removeBranch: function(idBranch){
                $('#confirm').modal('show');
                var callBack = function(data){
                    window.location.reload();
                };
                var errorCallBack = function(){};
                $('#delete').click(function (e) {
                    Kacana.ajax.branch.removeBranch(idBranch, callBack, errorCallBack);
                });
            }
        },
        tag:{
            init: function(){

            },
            showCreateForm: function(id) {
                var callBack = function(data){
                    $("#myModal").html(data);
                    $("#myModal").modal('show');
                };
                var errorCallBack = function(){};
                Kacana.ajax.tag.showCreateForm(id, callBack, errorCallBack);
            },
            createTag: function(){
                $("#btn-create").attr('disabled', true);
                var form_data = $("#form-create-tag").serialize();
                var callBack = function(data) {
                    $("#myModal").modal('hide');
                    data = JSON.parse(data);
                    var $tree = $("#tree-tags");
                    var parent_node = $tree.tree('getNodeById', data.parent_id);

                    if(parent_node){
                        $tree.tree('appendNode', {
                            label: data.name,
                            id: data.id,
                            childs: data.childs
                        }, parent_node);

                        $tree.tree('updateNode', parent_node, {
                            childs: data.childs_of_parent
                        });

                        $tree.tree('openNode', parent_node, true);
                    }else{
                        $tree.tree('appendNode', {
                            label: data.name,
                            id: data.id,
                            childs: data.childs
                        });
                    }
                };
                var errorCallBack = function(data){
                    json_result = JSON.parse(data.responseText);
                    if(typeof(json_result['name'])!=''){
                        $("#error-name").html(json_result['name']);
                    }
                };
                Kacana.ajax.tag.createTag(form_data, callBack, errorCallBack);
            },
            showEditForm: function(id){
                var callBack = function(data){
                    $("#myModal").html(data);
                    $("#myModal").modal('show');
                };
                var errorCallBack = function(){};
                Kacana.ajax.tag.showEditForm(id, callBack, errorCallBack);
            },
            editTag: function(){
                var form_data = $("#form-edit-tag").serialize();
                var callBack = function (data) {
                    data = JSON.parse(data);
                    $("#myModal").modal('hide');

                    var $tree = $("#tree-tags");
                    var node = $tree.tree('getNodeById', data.id);

                    $tree.tree('updateNode', node, data.name);

                    if(json_result['parent_id']!=0){
                        $tree.tree('openNode', $tree.tree('getNodeById', data.parent_id), true);
                    }
                };
                var errorCallBack = function(data){
                    json_result = JSON.parse(data);
                    if(typeof(json_result['name'])!=''){
                        $("#error-name").html(json_result['name']);
                    }
                };
                Kacana.ajax.tag.editTag(form_data, callBack, errorCallBack);
            },
            //setStatusTag: function(id, status){
            //    $.ajax({
            //        type:'get',
            //        url:'/tag/setStatusTag/'+id+'/'+ status,
            //        success:function(result){
            //            window.location.reload();
            //        }
            //    })
            //},
            removeTag: function(idTag){
                $('#confirm').modal('show');
                $('#delete').click(function (e) {
                    var callBack = function(data){
                        $("#confirm").modal('hide');
                        var $tree = $("#tree-tags");
                        var node = $tree.tree('getNodeById', idTag);
                        $tree.tree('removeNode', node);
                    };
                    var errorCallBack = function(){};
                    Kacana.ajax.tag.removeTag(idTag, callBack, errorCallBack);
                });
            },
            setType: function(idTag, type){
                $idselected = $("#_tag_"+idTag);
                var callBack = function(data){
                    var $tree = $("#tree-tags");
                    var node = $tree.tree('getNodeById', data.id);
                    $tree.tree('updateNode', node, {label: data.name, type: data.type});
                    if(data.parent_id!=0){
                        $tree.tree('openNode', $tree.tree('getNodeById', data.parent_id), true);
                    }
                };
                var errorCallBack = function(){};
                Kacana.ajax.tag.setType(idTag, type, callBack, errorCallBack);
            }
        }

    }
};

$.extend(true, Kacana, orderPackage);