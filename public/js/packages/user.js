var userPackage = {
  user:{

      init: function(){
          Kacana.user.listUsers();
          Kacana.user.createUser();
      },
      listUsers: function(){
          var columns = [
              {data:'id', name:'name'},
              {data:'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'image', name: 'image'},
              {data: 'role', name: 'role'},
              {data:'user_type', name:'user_type'},
              {data:'status', name:'status'},
              {data:'created', name:'created'},
              {data:'updated', name:'updated'},
              {data:'action', name:'active'}
          ];

          var btable = Kacana.datatable.init(columns, '/user/getUser');

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