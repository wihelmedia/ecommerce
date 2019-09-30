$(window).ready(function() {
  let baseUrl = $('#hiddenbaseurl').val();
  $('#modalLabel4').on('click', function () {
    $(this).val('');
    $('#no_ktp').val('');
    $('#no_kk').val('');
    $('#nama').val('');
    $('#jk').val('');
    $('#tempat_lahir').val('');
    $('#tgl_lahir').val('');
    $('#golda').val('');
    $('#agama').val('');
    $('#status_kawin').val('');
    $('#status_keluarga').val('');
    $('#status').val('');
    $('#kewarganegaraan').val('');
    $('#pendidikan').val('');
    $('#pekerjaan').val('');
    $('#no_hp').val('');
    $('#nm_ayah').val('');
    $('#nm_ibu').val('');
    $('#alamat').val('');
    $('#no_rumah').val('');
  });

    $('.list').on('click', function () {
    let id = $(this).data('id');
    $.ajax({
      url: baseUrl + 'rt/editwarga',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
          $('.card-img').attr('src', baseUrl + 'assets/img/profile/' + data[0].image);
          $('#no_ktpedit').val(data[0].no_ktp);
          $('#no_kkedit').val(data[0].no_kk);
          $('#namaedit').val(data[0].nama);
          $('#jkedit').val(data[0].jk);
          $('#tempat_lahiredit').val(data[0].tempat_lahir);
          $('#tgl_lahiredit').val(data[0].tgl_lahir);
          $('#goldaedit').val(data[0].golda);
          $('#agamaedit').val(data[0].agama);
          $('#status_kawinedit').val(data[0].status_kawin);
          $('#status_keluargaedit').val(data[0].status_keluarga);
          $('#statusedit').val(data[0].status);
          $('#kewarganegaraanedit').val(data[0].kewarganegaraan);
          $('#pendidikanedit').val(data[0].pendidikan);
          $('#pekerjaanedit').val(data[0].pekerjaan);
          $('#no_hpedit').val(data[0].no_hp);
          $('#nm_ayahedit').val(data[0].nm_ayah);
          $('#nm_ibuedit').val(data[0].nm_ibu);
          $('#alamatedit').val(data[0].alamat);
          $('#no_rumahedit').val(data[0].no_rumah);
      }
    });
      $('#editwarga').on('click', function () {
            var no_ktp =  $('#no_ktpedit').val();
            var no_kk = $('#no_kkedit').val();
            var nama =  $('#namaedit').val();
            var jk =  $('#jkedit').val();
            var tempat_lahir =  $('#tempat_lahiredit').val();
            var tgl_lahir =  $('#tgl_lahiredit').val();
            var golda =  $('#goldaedit').val();
            var agama =  $('#agamaedit').val();
            var status_kawin = $('#status_kawinedit').val();
            var status_keluarga = $('#status_keluargaedit').val();
            var status = $('#statusedit').val();
            var kewarganegaraan = $('#kewarganegaraanedit').val();
            var pendidikan = $('#pendidikanedit').val();
            var pekerjaan = $('#pekerjaanedit').val();
            var no_hp = $('#no_hpedit').val();
            var nm_ayah = $('#nm_ayahedit').val();
            var nm_ibu = $('#nm_ibuedit').val();
            var alamat = $('#alamatedit').val();
            var no_rumah = $('#no_rumahedit').val();
            var files = $('#file').prop('files')[0];
            var img = new FormData(this);
            img.append('inputfile', files);
            $.ajax({
                url: baseUrl + 'rt/updatewarga',
                cache: false,
                contentType: false,
                processData: false,
                data: { 
                    no_ktpedit: no_ktp,
                    no_kkedit: no_kk,
                    namaedit: nama,
                    jkedit: jk,
                    tempat_lahiredit: tempat_lahir,
                    tgl_lahiredit: tgl_lahir,
                    goldaedit: golda,
                    agamaedit: agama,
                    status_kawinedit: status_kawin,
                    status_keluargaedit: status_keluarga,
                    statusedit: status,
                    kewarganegaraanedit: kewarganegaraan,
                    pendidikanedit: pendidikan,
                    pekerjaanedit: pekerjaan,
                    no_hpedit: no_hp,
                    nm_ayahedit: nm_ayah,
                    nm_ibuedit: nm_ibu,
                    alamatedit: alamat,
                    no_rumahedit: no_rumah,
                    img: img
                },
                method: 'post',
                dataType: 'json',
                success: function (data) {
                    document.location.href = baseUrl + 'rt/datawarga';
                }
            });
        });
      
  });
  $('#delwarga').on('click', function () {
    alert('Sure your will delete this warga??');
  });
});
