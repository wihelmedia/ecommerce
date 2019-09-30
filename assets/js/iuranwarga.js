$(window).ready(function () {
    let baseUrl = $('#hiddenbaseurl').val();
    // $('#modalLabel8').on('click', function () {
    //     $(this).val('');
    //     $('#thn_iuran').val('');
    //     $('#bulan').val('');
    //     $('#ket').val('');
    //     $('#nama_kk').val('');
    //     $('#alamat').val('');
    //     $('#no_rumah').val('');
    //     $('#iuran').val('');
    //     $('#tgl_pembukuan').val('');
    // });

    $('.iura').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'warga/editeiuran',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#thn_iuranedit').val(data[0].thn_iuran);
                $('#bulanedit').val(data[0].bulan);
                $('#ketedit').val(data[0].ket);
                $('#nama_kkedit').val(data[0].nama_kk);
                $('#alamatedit').val(data[0].alamat);
                $('#no_rumahedit').val(data[0].no_rumah);
                $('#iuranedit').val(data[0].iuran);
                $('#tgl_pembukuanedit').val(data[0].tgl_pembukuan);
            }
        });
        $('#editiuran').on('click', function () {
            var thn_iuran = $('#thn_iuranedit').val();
            var bulan = $('#bulanedit').val();
            var ket = $('#ketedit').val();
            var nama_kk = $('#nama_kkedit').val();
            var alamat = $('#alamatedit').val();
            var no_rumah = $('#no_rumahedit').val();
            var iuran = $('#iuranedit').val();
            var tgl_pembukuan = $('#tgl_pembukuanedit').val();
            $.ajax({
                url: baseUrl + 'warga/updateiuran',
                data: {
                    id: id,
                    thn_iuranedit: thn_iuran,
                    bulanedit: bulan,
                    ketedit: ket,
                    nama_kkedit: nama_kk,
                    alamatedit: alamat,
                    no_rumahedit: no_rumah,
                    iuranedit: iuran,
                    tgl_pembukuanedit: tgl_pembukuan
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    document.location.href = baseUrl + 'warga/iuranwarga';
                }
            });
        });

    });
    $('#deliuran').on('click', function () {
        alert('Sure your will delete this iuran??');
    });
});
