$(window).ready(function () {
    let baseUrl = $('#hiddenbaseurl').val();

    $('.delpesan').on('click', function () {
        $('#modaluser6').html('Detail Pesan');
        // $('#modalLabel2').html('Edit Submenu');
        // $('#modalLabel5').html('Form Edit Data Warga');
        $('#approvsurat').html('Setuju');
        let id = $(this).data('id');

        $.ajax({
            url: baseUrl + 'rt/detailpesan',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#modaluser6').html('Detail Pesan ' + data[0].name);
                $('#id').val(data[0].id);
                $('#no_hp').val(data[0].no_hp);
                $('#no_ktp').val(data[0].no_ktp);
                $('#name').val(data[0].name);
                $('#keperluan').val(data[0].keperluan);
                $('#status').val(data[0].status);
                $('#date_created').val(data[0].date_created);
                // $('#golda').val(data[0].golda);
                // $('#agama').val(data[0].agama);
                // $('#status_kawin').val(data[0].status_kawin);
                // $('#status_keluarga').val(data[0].status_keluarga);
                // $('#status').val(data[0].status);
                // $('#kewarganegaraan').val(data[0].kewarganegaraan);
                // $('#pendidikan').val(data[0].pendidikan);
                // $('#pekerjaan').val(data[0].pekerjaan);
                // $('#nm_ayah').val(data[0].nm_ayah);
                // $('#nm_ibu').val(data[0].nm_ibu);
                // $('#alamat').val(data[0].alamat);
                // $('#no_rumah').val(data[0].no_rumah);
            }
        });
        $('#approvsurat').on('click', function () {
            $('#form').attr('action', baseUrl + 'rt/updatepesan');
            // var id = $('#id').val();
            var no_hp = $('#no_hp').val();
            var name = $('#name').val();
            // var jk = $('#jk').val();
            // var tempat_lahir = $('#tempat_lahir').val();
            // var tgl_lahir = $('#tgl_lahir').val();
            // var golda = $('#golda').val();
            // var agama = $('#agama').val();
            // var status_kawin = $('#status_kawin').val();
            // var status_keluarga = $('#status_keluarga').val();
            var status = 'P';
            // var kewarganegaraan = $('#kewarganegaraan').val();
            // var pendidikan = $('#pendidikan').val();
            // var pekerjaan = $('#pekerjaan').val();
            // var nm_ayah = $('#nm_ayah').val();
            // var nm_ibu = $('#nm_ibu').val();
            // var alamat = $('#alamat').val();
            // var no_rumah = $('#no_rumah').val();
            $.ajax({
                url: baseUrl + 'rt/updatepesan',
                data: {
                    // id: id,
                    no_hp: no_hp,
                    name: name,
                    // jk: jk,
                    // tempat_lahir: tempat_lahir,
                    // tgl_lahir: tgl_lahir,
                    // golda: golda,
                    // agama: agama,
                    // status_kawin: status_kawin,
                    // status_keluarga: status_keluarga,
                    status: status
                    // kewarganegaraan: kewarganegaraan,
                    // pendidikan: pendidikan,
                    // pekerjaan: pekerjaan,
                    // nm_ayah: nm_ayah,
                    // nm_ibu: nm_ibu,
                    // alamat: alamat,
                    // no_rumah: no_rumah
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    document.location.href = baseUrl + 'rt/pengajuan';
                }
            });
        });

    });
    // $('#addwarga').on('click', function () {
    //     $('#form').attr('action', baseUrl + 'rt/datawarga');
    // });
    // $('.delsur').on('click', function () {
    //     alert('Sure your will delete this message??');
    // });
    // $('.menu').on('click', function () {
    //     alert('Sure your will delete this menu??');
    // });
    // $('.submenu').on('click', function () {
    //     alert('Sure your will delete this submenu??');
    // });
});
