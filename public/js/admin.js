var Kacana ={};;var datatablePackage = {
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

$.extend(true, Kacana, productPackage);;var userPackage = {
  user:{

      init: function(){
          Kacana.user.listUsers();
          Kacana.user.createUser();
      },
      listUsers: function(){
          var columns = ['id', 'name', 'email', 'image', 'role', 'user_type', 'status', 'created', 'updated', 'active']
          var btable = Kacana.datatable.init('table', columns, '/user/getUser');

          $("#search-form").on('submit', function(e){
              btable.search($("#search-name").val()).draw() ;
              e.preventDefault();
          })
      },

      showFormCreateUser: function(){
          $.ajax({
              type:'get',
              url:'/user/showCreateForm',
              success:function(result){
                  $("#createModal").html(result);
                  $("#createModal").modal('show');
              }
          })
      },
      createUser: function(){
          $("#btn-create").attr('disabled', true);
          var form_data = new FormData();
          var file_image = $('#image').prop("files")[0];
          var other_data = $("#form-create-user").serialize();
          form_data.append('image', file_image);
          var request = $.ajax({
              type: 'post',
              url: '/user/create?' + other_data,
              contentType: false,
              processData: false
          });
          request.done(function (response, textStatus, jqXHR) {
              window.location.reload();
          });
          request.fail(function(jqXHR, textStatus, errorThrown){
              json_result = JSON.parse(jqXHR.responseText);
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
          })

      },
      removeUser: function(id){
          $('#confirm').modal('show');
          $('#delete').click(function (e) {
              $.ajax({
                  type:'get',
                  url:'/user/remove/'+id,
                  success:function(){
                      window.location.reload();
                  }
              })
              return false;
          });
      },
      setStatusUser: function(id, status){
          $.ajax({
              type:'get',
              url:'/user/setStatus/'+id+'/'+status,
              success:function(result){
                  window.location.reload();
              }
          })
      }
  }
};

$.extend(true, Kacana, userPackage);