$(window).ready(function () {
    let baseUrl = $('#hiddenbaseurl').val();
    $('.keg').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'rt/editekegiatan',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#idkeg').val(data[0].id);
                $('#judul_kegiatanedit').val(data[0].judul_kegiatan);
                $('#isi_kegiatanedit').html(data[0].isi_kegiatan);
                $('.card-img').attr('src', baseUrl + 'assets/img/info/' + data[0].gambar);
            }
        });
            $('#eddkeg').on('click', function () {
                var idkeg = $('#idkeg').val();
                var judul_kegiatan = $('#judul_kegiatanedit').val();
                var isi_kegiatan = $('#isi_kegiatanedit').val();
                var files = $('#file').prop('files')[0];
                var img = new FormData(this);
                img.append('inputfile', files);
                $.ajax({
                    url: baseUrl + 'rt/updatekegiatan',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: {
                        id: idkeg,
                        judul_kegiatanedit: judul_kegiatan,
                        isi_kegiatanedit: isi_kegiatan,
                        img: img
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function (data) {
                        document.location.href = baseUrl + 'rt/info';
                    }
                });
            });
       
        
    });
});
