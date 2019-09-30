<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vvendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/js/submenu.js'); ?>"></script>
<script src="<?= base_url('assets/js/menu.js'); ?>"></script>
<script src="<?= base_url('assets/js/admin.js'); ?>"></script>
<script src="<?= base_url('assets/js/user.js'); ?>"></script>
<script src="<?= base_url('assets/js/rt.js'); ?>"></script>
<script src="<?= base_url('assets/js/pengajuan.js'); ?>"></script>
<script src="<?= base_url('assets/js/script.js'); ?>"></script>
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