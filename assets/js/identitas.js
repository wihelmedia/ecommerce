$(window).ready(function () {
    let baseUrl = $('#hiddenbaseurl').val();
    $('.iden').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'rt/editeidentitas',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#provinsiedit').val(data[0].provinsi);
                $('#kab_kotaedit').val(data[0].kab_kota);
                $('#kecamatanedit').val(data[0].kecamatan);
                $('#no_tlpedit').val(data[0].no_tlp);
                $('#desa_keledit').val(data[0].desa_kel);
                $('#dusunedit').val(data[0].dusun);
                $('#alamat_kantor_desaedit').val(data[0].alamat_kantor_desa);
                $('#kd_posedit').val(data[0].kd_pos);
                $('#rwedit').val(data[0].rw);
                $('#rtedit').val(data[0].rt);
                $('#nm_ketua_rtedit').val(data[0].nm_ketua_rt);
                $('#alamat_rumah_rtedit').val(data[0].alamat_rumah_rt);
            }
        });
        $('#editidentitas').on('click', function () {
            var provinsi = $('#provinsiedit').val();
            var kab_kota = $('#kab_kotaedit').val();
            var kecamatan = $('#kecamatanedit').val();
            var no_tlp = $('#no_tlpedit').val();
            var desa_kel = $('#desa_keledit').val();
            var dusun = $('#dusunedit').val();
            var alamat_kantor_desa = $('#alamat_kantor_desaedit').val();
            var kd_pos = $('#kd_posedit').val();
            var rw = $('#rwedit').val();
            var rt = $('#rtedit').val();
            var nm_ketua_rt = $('#nm_ketua_rtedit').val();
            var alamat_rumah_rt = $('#alamat_rumah_rtedit').val();
            $.ajax({
                url: baseUrl + 'rt/updateidentitas',
                data: {
                    id: id,
                    provinsiedit: provinsi,
                    kab_kotaedit: kab_kota,
                    kecamatanedit: kecamatan,
                    no_tlpedit: no_tlp,
                    desa_keledit: desa_kel,
                    dusunedit: dusun,
                    alamat_kantor_desaedit: alamat_kantor_desa,
                    kd_posedit: kd_pos,
                    rwedit: rw,
                    rtedit: rt,
                    nm_ketua_rtedit: nm_ketua_rt,
                    alamat_rumah_rtedit: alamat_rumah_rt
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    document.location.href = baseUrl + 'rt/identitas';
                }
            });
        });

    });
    // $('#delwarga').on('click', function () {
    //     alert('Sure your will delete this warga??');
    // });
});
