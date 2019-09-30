<div class="container">
  <div class="copyright">
    &copy; Copyright <strong>SMA-RT</strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Rapid
        -->
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</div>
</footer><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- Uncomment below i you want to use a preloader -->
<!-- <div id="preloader"></div> -->

<!-- JavaScript Libraries -->
<script src="<?= base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/jquery/jquery-migrate.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/easing/easing.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/mobile-nav/mobile-nav.js'); ?>"></script>
<script src="<?= base_url('assets/lib/wow/wow.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/waypoints/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/counterup/counterup.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/isotope/isotope.pkgd.min.js'); ?>"></script>
<script src="<?= base_url('assets/lib/lightbox/js/lightbox.min.js'); ?>"></script>
<!-- Contact Form JavaScript File -->
<script src="<?= base_url('assets/contactform/contactform.js'); ?>"></script>

<!-- Template Main Javascript File -->
<script src="<?= base_url('assets/js/main.js'); ?>"></script>
<script src="<?= base_url('assets/js/pengajuan.js'); ?>"></script>
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
  })();
</script>
<!-- /WhatsHelp.io widget -->

</body>

</html>