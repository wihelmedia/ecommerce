$(window).ready(function() {
  let baseUrl = $('#hiddenbaseurl').val();
  $('#modaluser1').on('click', function () {
    $('#modaluser2').html('Add User');
    $('#name').val('');
    $('#email').val('');
    $('#image').val('');
    $('#password').val('');
    $('#role_id').val('');
    $('#date_created').val('');
    $('#addusers').html('Add');
    $('#form').attr('action', baseUrl + 'admin/addNewUser');
  });

  $('.edituser').on('click', function() {
    $('#modaluser2').html('Edit User');
    $('#addusers').html('Edit');
    let id = $(this).data('id');

    $.ajax({
      url: baseUrl + 'admin/getUserByID',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#name').val(data[0].name);
        $('#email').val(data[0].email);
        $('#image').val(data[0].image);
        $('#password').val(data[0].password);
        $('#role_id').val(data[0].role_id);
        $('#date_created').val(data[0].date_created);
      }
    });

    $('#addusers').on('click', function () {
      $('#form').attr('action', baseUrl + 'admin/upUserByID/' + id);
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
      type: 'post',
      data: {
        roleId: roleId,
        menuId: menuId
      },
      success: function () {
        document.location.href = baseUrl + 'admin/roleaccess/' + roleId;
      }
    })
  });
});
