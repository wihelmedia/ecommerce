<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; SMA-RT <?= date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingin keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Silakan logout untuk mengakhiri sesi anda.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script> -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<!-- Page level custom scripts -->
<script src="<?= base_url('assets/js/demo/datatables-demo.js'); ?>"></script>
<script src="<?= base_url('assets/js/submenu.js'); ?>"></script>
<script src="<?= base_url('assets/js/menu.js'); ?>"></script>
<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
<script src="<?= base_url('assets/js/user.js'); ?>"></script>
<script src="<?= base_url('assets/js/rt.js'); ?>"></script>
<script src="<?= base_url('assets/js/pengajuan.js'); ?>"></script>
<script src="<?= base_url('assets/js/jumlahwarga.js'); ?>"></script>
<script src="<?= base_url('assets/js/maps.js'); ?>"></script>
<script src="<?= base_url('assets/js/iuranwarga.js'); ?>"></script>
<script src="<?= base_url('assets/js/userdata.js'); ?>"></script>
<script src="<?= base_url('assets/js/identitas.js'); ?>"></script>
<script src="<?= base_url('assets/js/kartukeluarga.js'); ?>"></script>
<script src="<?= base_url('assets/js/info.js'); ?>"></script>
<script src="<?= base_url('assets/js/smart.js'); ?>"></script>
<script src="<?= base_url('assets/js/script.js'); ?>"></script>
<script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
  (function() {

    var options = {
      whatsapp: "081256981174", // WhatsApp number
      sms: "081256981174", // Sms phone number
      call_to_action: "Tanya RT Anda", // Call to action
      button_color: "#FF6550", // Color of button
      position: "left", // Position may be 'right' or 'left'
      order: "whatsapp,sms", // Order of buttons
    };
    var proto = document.location.protocol,
      host = "whatshelp.io",
      url = proto + "//static." + host;
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url + '/widget-send-button/js/init.js';
    s.onload = function() {
      WhWidgetSendButton.init(host, proto, options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);


    $.ajax({
      url: "<?= base_url() ?>user/gettot",
      type: "POST",
      dataType: "json",
      data: {},
      success: function(data) {
        let pesan = data.pesan;
        setInterval(function() {
          $('#bellku').html(data.total);
        }, 2000);
        content = '';
        $.each(pesan, function(i, data) {
          content += '<a class="dropdown-item d-flex align-items-center" href="#"><div class="mr-3"><div class="icon-circle bg-primary"><i class="fas fa-file-alt text-white"></i></div></div><div><div class="small text-gray-500">' + data.date_created + '</div><span class="font-weight-bold">' + data.keperluan + '</span></div></a>';
        });
        $('#dropdownlist').html(content);
      }
    });

    tinymce.init({
      selector: '#isi_kegiatan'
    });

    tinymce.init({
      selector: '#isi_kegiatanedit'
    });
    // ClassicEditor
    //   .create(document.querySelector('#isi_kegiatan'))
    //   .catch(error => {
    //     console.error(error);
    //   });
  })();
</script>
<!-- /WhatsHelp.io widget -->
</body>

</html>