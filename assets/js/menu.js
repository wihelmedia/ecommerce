$(window).ready(function () {
  let baseUrl = $('#hiddenbaseurl').val();
  $('#modalLabel3').on('click', function () {
    $('#modalLabel4').html('Add Menu');
    $('#menu').val('');
    $('#add').html('Add');
    $('#form').attr('action', baseUrl + 'menu');
  });

  $('.edit').on('click', function() {
    $('#modalLabel4').html('Edit Menu');
    $('#add').html('Edit');
    let id = $(this).data('id');

    $.ajax({
      url: baseUrl + 'menu/showMenu',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#menu').val(data[0].menu);
      }
    });

    $('#add').on('click', function () {
      $('#form').attr('action', baseUrl + 'menu/updateMenu/' + id);
    });
  });

  $('.menu').on('click', function () {
    alert('Sure your will delete this menu??');
  });
});
