<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <title>Lokasi Rumah Warga</title>
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
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAxtzXf6w7gNHta8rgaGe4aQJe0CuaDRkM&callback&sensor=false"></script>
  <style>
    #map {
      width: 500px;
      height: 400px;
      border: 1px solid blue;
    }
  </style>
  <script>
    (function() {
      window.onload = function() {
        var marker;
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }     
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var infoWindow = new google.maps.InfoWindow;      
        var bounds = new google.maps.LatLngBounds();
 
 
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
          function addMarker(lat, lng, info) {
            var pt = new google.maps.LatLng(lat, lng);
            bounds.extend(pt);
            var marker = new google.maps.Marker({
                map: map,
                position: pt
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
          }
 
          <?php
            $query = $this->db->query("select * from warga");
            while ($data = mysqli_fetch_array($query)) {
            $lat = $data['lat'];
            $lon = $data['lng'];
            $nama = $data['nama'];
            echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
            }
          ?>
        }
      google.maps.event.addDomListener(window, 'load', initialize);
      };
    })();
  </script>
</head>

<body>
  <?php
    for ($x = 0; $x < count($kordinat); $x++) {
      $lat = json_encode($kordinat[$x]['lat']);
      $lng = json_encode($kordinat[$x]['lng']);
    }
  ?>
  <center>
    <input type="hidden" name="lat" id="lat"value="<?= $lat; ?>"/>
    <input type="hidden" name="lng" id="lng"value="<?= $lng; ?>"/>
    <h4>Lokasi Rumah Warga</h4>
    <h5>Jumlah Warga : <?= $jumlah; ?></h5>
    <div id="map"></div>
  </center>
</body>

</html>