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

    $('.editus').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: baseUrl + 'admin/edituser',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#no_ktpedit').val(data[0].no_ktp);
                $('#nameedit').val(data[0].name);
                $('#emailedit').val(data[0].email);
                $('#password1edit').val(data[0].password);
            }
        });
        $('#eddusers').on('click', function () {
            var no_ktp = $('#no_ktpedit').val();
            var name = $('#nameedit').val();
            var email = $('#emailedit').val();
            var password1 = $('#password1edit').val();
            $.ajax({
                url: baseUrl + 'admin/updateuser',
                data: {
                    id: id,
                    no_ktpedit: no_ktp,
                    nameedit: name,
                    emailedit: email,
                    password1edit: password1
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    document.location.href = baseUrl + 'admin/userdata';
                }
            });
        });

    });
    // $('#deliuran').on('click', function () {
    //     alert('Sure your will delete this iuran??');
    // });
});
