$(window).ready(function () {
    let baseUrl = $('#hiddenbaseurl').val();
    $('.kartk').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'rt/editekartukeluarga',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#no_kkedit').val(data[0].no_kk);
                $('#kpl_keluargaedit').val(data[0].kpl_keluarga);
                $('#alamatedit').val(data[0].alamat);
                $('#rtedit').val(data[0].rt);
                $('#rwedit').val(data[0].rw);
                $('#desa_keledit').val(data[0].desa_kel);
                $('#kecamatanedit').val(data[0].kecamatan);
                $('#kab_kotaedit').val(data[0].kab_kota);
                $('#kd_posedit').val(data[0].kd_pos);
                $('#provinsiedit').val(data[0].provinsi);
            }
        });
        $('#editkartu').on('click', function () {
            var no_kk = $('#no_kkedit').val();
            var kpl_keluarga = $('#kpl_keluargaedit').val();
            var alamat = $('#alamatedit').val();
            var rt = $('#rtedit').val();
            var rw = $('#rwedit').val();
            var desa_kel = $('#desa_keledit').val();
            var kecamatan = $('#kecamatanedit').val();
            var kab_kota = $('#kab_kotaedit').val();
            var kd_pos = $('#kd_posedit').val();
            var provinsi = $('#provinsiedit').val();
            $.ajax({
                url: baseUrl + 'rt/updatekartukeluarga',
                data: {
                    id: id,
                    no_kkedit: no_kk,
                    kpl_keluargaedit: kpl_keluarga,
                    alamatedit: alamat,
                    rtedit: rt,
                    rwedit: rw,
                    desa_keledit: desa_kel,
                    kecamatanedit: kecamatan,
                    kab_kotaedit: kab_kota,
                    kd_posedit: kd_pos,
                    provinsiedit: provinsi
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    document.location.href = baseUrl + 'rt/kartukeluarga';
                }
            });
        });

    });
    // $('#delwarga').on('click', function () {
    //     alert('Sure your will delete this warga??');
    // });
});
