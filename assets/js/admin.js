$(window).ready(function() {
  let baseUrl = $('#hiddenbaseurl').val();
  $('.edituser').on('click', function() {
    let id = $(this).data('id');

    $.ajax({
      url: baseUrl + 'admin/getUserByID',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#no_ktpedit').val(data[0].no_ktp);
        $('#nameedit').val(data[0].name);
        $('#emailedit').val(data[0].email);
        // $('#imageedit').val(data[0].image);
        $('#password1edit').val(data[0].password);
        // $('#role_id').val(data[0].role_id);
        // $('#date_created').val(data[0].date_created);
      }
    });
        var no_ktp = $('#no_ktpedit').val();
        var name = $('#nameedit').val();
        var email = $('#emailedit').val();
        var password = $('#password1edit').val();
        $('#eddusers').on('click', function () {
              $.ajax({
              url: baseUrl + 'admin/updateuser',
              data: {
                id : id,
                no_ktpedit: no_ktp,
                nameedit: name,
                emailedit: email,
                password1edit: password
              },
              method: 'post',
              dataType: 'json',
              success: function(data) {
                document.location.href = baseUrl + 'admin/userdata';
              }
            });
        });
    });
  $('.badge-danger').on('click', function () {
    alert('Sure your will delete this submenu??');
  });

  $('.form-check-input').on('click', function() {
    let roleId = $(this).data('role');
    let menuId = $(this).data('menu');

    $.ajax({
      url: baseUrl + 'admin/changeaccess',
      method: 'post',
      data: {
        roleId: roleId,
        menuId: menuId
      },
      success: function () {
        document.location.href = baseUrl + 'admin/role';
      }
    });
  });



  // $.ajax({
  //   url: baseUrl + 'admin/gettotal',
  //   method: "POST",
  //   dataType: "json",
  //   success: function (data) {
  //     console.log(data);
  //     $('.badge-counter').html(data.pesan);
  //       $('.menus').prepend(data.notification);
  //       if (data.unseen_notification > 0) {
  //         $('.notif').html(data.unseen_notification);
  //       } else {
  //         $('.notif').html('');
  //       }
  //     }
  //   });
});
