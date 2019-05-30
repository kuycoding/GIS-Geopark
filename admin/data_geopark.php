<?php include_once('auth.php'); ?>

<?php include_once('template/header.php'); ?>
<?php include_once('template/sidebar.php'); ?>
<?php include_once('template/topbar.php'); ?>

<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
    var marker;

    function initialize() {

        // Variabel untuk menyimpan informasi (desc)
        var infoWindow = new google.maps.InfoWindow;

        //  Variabel untuk menyimpan peta Roadmap
        var mapOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        // Pembuatan petanya
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        // Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();

        // Pengambilan data dari database
        <?php
        $query = mysqli_query($con, "select * from data_geo");
        while ($data = mysqli_fetch_array($query)) {
            $nama = $data['nama_geo'];
            $lat = $data['lat'];
            $lon = $data['longitude'];
            $des = $data['deskripsi'];
            $gambar = $data['image'];

            echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");
        }
        ?>

        // Proses membuat marker
        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
        }

        // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, map, infoWindow, html) {
            google.maps.event.addListener(marker, 'click', function() {

                infoWindow.setContent(html);
                infoWindow.open(map, marker);
            });
        }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class="container-fluid">
    <div class="col-xl-12 col-lg-12">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div id="map-canvas" style="width:100%;height:440px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
<?php include('template/footer.php') ?>