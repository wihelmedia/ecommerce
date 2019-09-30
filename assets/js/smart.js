$('.selengkapnya').on('click', function () {
    let baseUrl = $('#hiddenbaseurl').val();
    let id = $(this).data('id');
    $.ajax({
        url: baseUrl + 'smart/detailkegiatan/' + id,
        data: { id: id },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#judulkeg').html(data[0].judul_kegiatan);
            $('#isikeg').html(data[0].isi_kegiatan);
            $('.img-profile').attr('src', baseUrl + 'assets/img/profile/' + data[0].gambar_penulis);
            $('.img-fluid').attr('src', baseUrl + 'assets/img/info/' + data[0].gambar);
        }
    });
});