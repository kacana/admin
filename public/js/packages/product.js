var productPackage = {
  product:{
      init: function(){
          Kacana.product.listProducts();
          Kacana.product.showEditProductForm();
          Kacana.product.createProduct();
          Kacana.product.editProduct();
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

      createProduct: function(){
          $("#btn-create").attr('disabled', true);
          var form_data = new FormData();
          var file_image = $('#image').prop("files")[0];
          var other_data = $("#form-create-product").serialize();
          form_data.append('image', file_image);
          form_data.append('descriptions', CKEDITOR.instances['description'].getData());
          var request = $.ajax({
              type: 'post',
              url: '/product/createProduct?' + other_data,
              data: form_data,
              contentType: false,
              processData: false
          });
          request.done(function (response, textStatus, jqXHR) {
              window.location.reload();
          });
          request.fail(function(jqXHR, textStatus, errorThrown){
              json_result = JSON.parse(jqXHR.responseText);
              if(typeof(json_result['image'])!=''){
                  $("#error-image").html(json_result['image']);
              }

              if(typeof(json_result['name'])!=''){
                  $("#error-name").html(json_result['name']);
              }

              if(typeof(json_result['price'])!=''){
                  $("#error-price").html(json_result['price']);
              }

              if(typeof(json_result['sell_price'])!=''){
                  $("#error-sell-price").html(json_result['sell_price']);
              }
              $("#btn-create").attr('disabled', false);
          })

      },
      listTags: function(){
          var key = $("#tags").val();
          var token = $("#form-create-product input[name=_token]").val();
          $.ajax({
              type:'get',
              url:'product/listTags?_token='+token+'&key='+key,
              success: function(result){
                  $("#select-tags").html(result);
              }
          });

      },
      removeTags: function(){
          $("#select-tags").html('');
      },
      removeProduct: function(idProduct){
          $('#confirm').modal('show');
          $('#delete').click(function (e) {
              $.ajax({
                  type:'get',
                  url:'/product/removeProduct/'+idProduct,
                  success:function(){
                      window.location.reload();
                  }
              })
              return false;
          });
      },
      setStatus: function(id, status){
          $.ajax({
              type:'get',
              url:'/product/setStatus/'+id+'/'+status,
              success:function(result){
                  window.location.reload();
              }
          })
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

              var request = $.ajax({
                  type: 'post',
                  url: '/branch/createBranch?' + other_data,
                  data: form_data,
                  contentType: false,
                  processData: false
              });
              request.done(function (response, textStatus, jqXHR) {
                  window.location.reload();
              });
              request.fail(function(jqXHR, textStatus, errorThrown){
                  json_result = JSON.parse(jqXHR.responseText);
                  if(typeof(json_result['image'])!=''){
                      $("#error-image").html(json_result['image']);
                  }

                  if(typeof(json_result['name'])!=''){
                      $("#error-name").html(json_result['name']);
                  }
              })
          },
          showEditBranchForm: function(idBranch){
              $.ajax({
                  type:'get',
                  url:'/branch/showEditFormBranch/'+idBranch,
                  success:function(result){
                      $("#editModal").html(result);
                      $("#editModal").modal('show');
                  }
              })
          },
          editBranch: function(){
              var form_data = new FormData();
              var file_image = $('#image').prop("files")[0];
              var other_data = $("#form-create-branch").serialize();
              form_data.append('image', file_image);

              var request = $.ajax({
                  type: 'post',
                  url: '/branch/editBranch?'+ other_data,
                  data: form_data,
                  contentType: false,
                  processData: false
              });
              request.done(function (response, textStatus, jqXHR) {
                window.location.reload();
              });
              request.fail(function(jqXHR, textStatus, errorThrown){
                  json_result = JSON.parse(jqXHR.responseText);
                  if(typeof(json_result['image'])!=''){
                      $("#error-image").html(json_result['image']);
                  }

                  if(typeof(json_result['name'])!=''){
                      $("#error-name").html(json_result['name']);
                  }
              })
          },
          setStatusBranch: function(id, status){
              $.ajax({
                  type:'get',
                  url:'/branch/setStatusBranch/'+id+'/'+status,
                  success:function(result){
                      window.location.reload();
                  }
              })
          },
          removeBranch: function(idBranch){
              $('#confirm').modal('show');
              $('#delete').click(function (e) {
                  $.ajax({
                      type:'get',
                      url:'/branch/removeBranch/'+idBranch,
                      success:function(){
                          window.location.reload();
                      }
                  })
                  return false;
              });
          }
      },
      tag:{
          init: function(){

          },
          showCreateForm: function(id) {
              $.ajax({
                  type: 'get',
                  url:'/tag/showFormCreate/'+id,
                  success: function(result){
                      $("#myModal").html(result);
                      $("#myModal").modal('show');
                  }
              })
          },
          createTag: function(){
              $("#btn-create").attr('disabled', true);
              var form_data = $("#form-create-tag").serialize();

              var request = $.ajax({
                  type: 'post',
                  url: '/tag/createTag?'+form_data,
                  contentType: false,
                  processData: false
              });
              request.done(function (response, textStatus, jqXHR) {
                  window.location.reload();
              });
              request.fail(function(jqXHR, textStatus, errorThrown){
                  json_result = JSON.parse(jqXHR.responseText);
                  if(typeof(json_result['name'])!=''){
                      $("#error-name").html(json_result['name']);
                  }
              })
          },
          showEditForm: function(id){
              $.ajax({
                  type:'get',
                  url:'/tag/showEditFormTag/'+id,
                  success:function(result){
                      $("#myModal").html(result);
                      $("#myModal").modal('show');
                  }
              })
          },
          editTag: function(){
              var form_data = $("#form-edit-tag").serialize();
              var request = $.ajax({
                  type: 'post',
                  url: '/tag/editTag?'+form_data,
                  contentType: false,
                  processData: false
              });
              request.done(function (response, textStatus, jqXHR) {
                  window.location.reload();
              });
              request.fail(function(jqXHR, textStatus, errorThrown){
                  json_result = JSON.parse(jqXHR.responseText);

                  if(typeof(json_result['name'])!=''){
                      $("#error-name").html(json_result['name']);
                  }
              })
          },
          setStatusTag: function(id, status){
              $.ajax({
                  type:'get',
                  url:'/tag/setStatusTag/'+id+'/'+ status,
                  success:function(result){
                      window.location.reload();
                  }
              })
          },
          removeTag: function(idTag){
              $('#confirm').modal('show');
              $('#delete').click(function (e) {
                  $.ajax({
                      type:'get',
                      url:'/tag/removeTag/'+idTag,
                      success:function(){
                          window.location.reload();
                      }
                  })
                  return false;
              });
          }
      }

  }
};

$.extend(true, Kacana, productPackage);