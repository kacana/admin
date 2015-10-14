var userPackage = {
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

              if(typeof(json_result['phone'])!=''){
                  $("#error-phone").html(json_result['phone']);
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