var productPackage = {
  product:{
      init: function(){
          Kacana.product.listProducts();
          $('#confirm').modal('show');
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

          var callBack = function(data){
              window.location.reload();
          };
          var errorCallBack = function(){};
          $('#delete').click(function (e) {
              $('#confirm').modal('show');
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
              Kacana.product.tag.initTreeTags();
              Kacana.product.tag.listProducts();
          },
          initTreeTags: function(){
            $("#tree-tags").tree({
                dragAndDrop: true,
                closedIcon: $('<i class="fa fa-plus-square-o"></i>'),
                openedIcon: $('<i class="fa fa-minus-square-o"></i>'),
                onCreateLi: function(node, $li){
                    countChild = node.childs;
                    nodeid = node.id;
                    str = '<span class="badge bg-gray childleft"><a href="javascript:void(0)"> '+countChild+' childs </a></span>';
                    str += ' <span><a class="btn bg-light-blue-active btn-sm" title="add tag" href="javascript:void(0)" onclick="Kacana.product.tag.showCreateForm('+nodeid+')"><i class="fa fa-plus"></i></a></span>';
                    if(node.parent_id===0){
                        if(node.type === 1){
                            str += ' <span><a class="btn bg-red btn-sm" id="_tag_'+nodeid+'" title="main tag" onclick="Kacana.product.tag.setType('+nodeid+', 0)"><i class="fa fa-arrow-circle-up"></i></a></span>';
                        }else{
                            str += ' <span><a class="btn bg-light-blue-active btn-sm" id="_tag_'+nodeid+'" title="main tag" onclick="Kacana.product.tag.setType('+nodeid+',1)"><i class="fa fa-arrow-circle-up"></i></a></span>';
                        }
                    }else{
                        if(node.type === 2){
                            str += ' <span><a class="btn bg-red btn-sm" title="sub tag" id="_tag_'+nodeid+'" onclick="Kacana.product.tag.setType('+nodeid+', 0)"><i class="fa fa-map-marker"></i></a></span>';
                        }else{
                            str += ' <span><a class="btn bg-light-blue-active btn-sm" id="_tag_'+nodeid+'" title="sub tag" onclick="Kacana.product.tag.setType('+nodeid+', 2)"><i class="fa fa-map-marker"></i></a></span>';
                        }
                    }
                    str += ' <span><a href="/tag/editTag/'+nodeid+'" class="btn bg-light-blue-active btn-sm" title="edit tag"><i class="fa fa-pencil"></i></a></span>';
                    str += ' <span><a class="btn bg-red btn-sm" title="remove tag" onclick="Kacana.product.tag.removeTag('+nodeid+')"><i class="fa fa-remove"></i></a></span>';
                    $li.find('.jqtree-title').after(str);
                }
            });
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
          listProducts: function(){
              var tagId = $("#tagId").val();
              var columns = ['id', 'name', 'image', 'price', 'sell_price', 'status', 'created', 'updated', 'action'];
              var btable = Kacana.datatable.init('table', columns, '/tag/getProducts/'+tagId);

              $("#search-form").on('submit', function(e){
                  btable.search($("#search-name").val()).draw() ;
                  e.preventDefault();
              })
          },
          removeTag: function(idTag){
              $('#delete').click(function (e) {
                  $('#confirm').modal('show');
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
          },
      }

  }
};

$.extend(true, Kacana, productPackage);