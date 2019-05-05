function allMenu() {
  $.getJSON('data/pizza.json', function(data) {
      let menu = data.menu;
      $.each(menu, function (i, data) {
        $('#daftar-menu').append('<div class="col-md-4"><div class="card mb-5"><img class="card-img-top" src="img/pizza/'+ data.gambar +'"><div class="card-body"><h5 class="card-title">'+ data.nama +'</h5><p class="card-text">'+ data.deskripsi +'</p><h5 class="card-title">Rp '+ data.harga +',-</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>');
      });
  });
}

$('.nav-link').click(function() {
  $('.nav-link').removeClass('active');
  $(this).addClass('active');
  let kategori = $(this).html();
  if (kategori == 'All Menu') {
    $('#daftar-menu').html('');
    allMenu();
    return;
  }
  $('h1').html(kategori);

  $.getJSON('data/pizza.json', function(data) {
      let menu = data.menu;
      let content = '';
      $.each(menu, function (i, data) {
        if (data.kategori == kategori.toLowerCase()) {
          content += '<div class="col-md-4"><div class="card mb-5"><img class="card-img-top" src="img/pizza/'+ data.gambar +'"><div class="card-body"><h5 class="card-title">'+ data.nama +'</h5><p class="card-text">'+ data.deskripsi +'</p><h5 class="card-title">Rp '+ data.harga +',-</h5><a href="#" class="btn btn-primary">Pesan Sekarang</a></div></div></div>';
        }
      });

  $('#daftar-menu').html(content);

  });
});
