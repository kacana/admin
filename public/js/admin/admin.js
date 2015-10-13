;var Kacana ={};;var ajaxPackage = {
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
        }

    }
};

$.extend(true, Kacana, ajaxPackage);;var datatablePackage = {
    datatable:{
        init: function (eid, columns, url) {
            column_arr = [];
            for (var i=0; i<columns.length; i++) {
                column_arr.push({
                    data:columns[i],
                    name:columns[i]
                });
            }
            $("#"+eid).DataTable({
                bLengthChange: false,
                aTargets: ['nosort'],
                processing: true,
                serverSide: true,
                ajax: url,
                columns: column_arr
            });
        }
    }

};

$.extend(true, Kacana, datatablePackage);;var productPackage = {
  product:{
      init: function(){
          Kacana.product.listProducts();
          Kacana.product.removeProduct();
      },
      listProducts: function(){
          var columns = ['id', 'name', 'image', 'price', 'sell_price', 'status', 'created', 'updated', 'action'];
          var btable = Kacana.datatable.init('table', columns, '/product/getProduct');

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

$.extend(true, Kacana, productPackage);;var userPackage = {
  user:{
      init: function(){
          Kacana.user.listUsers();
          Kacana.user.createUser();
          Kacana.user.setStatus();
      },
      listUsers: function(){
          var columns = ['id', 'name', 'email', 'image', 'role', 'user_type', 'status', 'created', 'updated', 'action']
          var btable = Kacana.datatable.init('table', columns, '/user/getUser');

          $("#search-form").on('submit', function(e){
              btable.search($("#search-name").val()).draw() ;
              e.preventDefault();
          })
      },
      showFormCreateUser: function(){
          var callBack= function(data){
                $("#createModal").html(data);
                $("#createModal").modal('show');
          };
          var errorCallBack = function(){};
          Kacana.ajax.user.showFormCreateUser(callBack, errorCallBack);
      },
      createUser: function(){
          $("#btn-create").attr('disabled', true);
          var form_data = new FormData();
          var file_image = $('#image').prop("files")[0];
          var other_data = $("#form-create-user").serialize();
          form_data.append('image', file_image);

          var callBack = function(data){
              window.location.reload();
          }
          var errorCallBack = function(data){
              json_result = JSON.parse(data.responseText);
              if(typeof(json_result['email'])!=''){
                  $("#error-email").html(json_result['email']);
              }

              if(typeof(json_result['name'])!=''){
                  $("#error-name").html(json_result['name']);
              }

              if(typeof(json_result['password'])!=''){
                  $("#error-password").html(json_result['password']);
              }
              $("#btn-create").attr('disabled', false);
          };
          Kacana.ajax.user.createUser(other_data, form_data, callBack, errorCallBack);
      },
      removeUser: function(id){
          $('#confirm').modal('show');
          var callBack = function(data){
              window.location.reload();
          };
          var errorCallBack = function(){};
          $('#delete').click(function (e) {
              Kacana.ajax.user.removeUser(id, callBack, errorCallBack);
          });
      },
      setStatus: function(id, status){
          var callBack = function(data){
              window.location.reload();
          };
          var errorCallBack = function(){};
          Kacana.ajax.user.setStatus(id, status, callBack, errorCallBack);
      }
  }
};

$.extend(true, Kacana, userPackage);