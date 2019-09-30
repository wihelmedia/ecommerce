(function () {
  $('.alert').addClass('show');

   $('#keyword').keyup(function() {
      search_table(this.value);
  });
  function search_table(value) {
    $('#table tbody tr').each(function() {
      let found = 'false';
      $(this).each(function() {
        if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
          found = 'true';
        }
      });
      if (found == 'true') {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  }

  ClassicEditor
      .create(document.querySelector('#isi_kegiatanedit'))
      .catch(error => {
        console.error(error);
      });
})();
