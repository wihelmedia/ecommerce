$(window).ready(function() {
  // alert
    $('.alert').addClass('show');

  // Modal
  // Submenu
  let baseUrl = $('#hiddenbaseurl').val();
  $('#modalLabel1').on('click', function () {
    $('#modalLabel2').html('Add Submenu');
    $('#title').val('');
    $('#menu_id').val('');
    $('#url').val('');
    $('#icon').val('');
    $('#add').html('Add');
    $('#form').attr('action', baseUrl + 'menu/submenu');
  });

  $('.badge-success').on('click', function() {
    $('#modalLabel2').html('Edit Submenu');
    $('#add').html('Edit');
    let id = $(this).data('id');

    $.ajax({
      url: baseUrl + 'menu/showSubMenu',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#title').val(data[0].title);
        $('#menu_id').val(data[0].menu_id);
        $('#url').val(data[0].url);
        $('#icon').val(data[0].icon);
      }
    });

    $('#add').on('click', function () {
      $('#form').attr('action', baseUrl + 'menu/updateSubMenu/' + id);
    });
  });
  $('.badge-danger').on('click', function () {
    alert('Sure your will delete this submenu??');
  });
});

$(window).ready(function () {
  // Menu
  let baseUrl = $('#hiddenbaseurl').val();
  $('#modalLabel3').on('click', function () {
    $('#modalLabel4').html('Add Menu');
    $('#menu').val('');
    $('#added').html('Add');
    $('#form').attr('action', baseUrl + 'menu');
  });

  $('.edit').on('click', function() {
    $('#modalLabel4').html('Edit Menu');
    $('#added').html('Edit');
    let id = $(this).data('id');

    $.ajax({
      url: baseUrl + 'menu/showMenu',
      data: {id : id},
      method: 'post',
      success: function(data) {
        console.log('ok');
      }
    });

    $('#added').on('click', function () {
      $('#form').attr('action', baseUrl + 'menu/updateMenu/' + id);
    });
  });
});
