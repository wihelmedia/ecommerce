$(window).ready(function() {
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
  $('.submenu').on('click', function () {
    alert('Sure your will delete this submenu??');
  });
});
