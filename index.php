<?php !isset($_SESSION['id_user']);
session_start();
?>
<?php include_once("template/header.php"); ?>
<script>
    if (typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF']; ?>');
    }
</script>
<div class="container-fluid">

    <div class="row">

        <?php
        $locations = array();
        $uname = "root";
        $pass = "";
        $servername = "localhost";
        $dbname = "gisgeopark";
        $db = new mysqli($servername, $uname, $pass, $dbname);

        //     $id = $_GET['id'];
        $query =  mysqli_query($con, "SELECT * FROM data_geo");
        //$number_of_rows = mysql_num_rows($db);  
        //echo $number_of_rows;
        while ($row =  mysqli_fetch_assoc($query)) {
            $name = $row['nama_geo'];
            $longitude = $row['longitude'];
            $latitude = $row['lat'];
            $link = $row['info'];
            $gambar = $row['image'];
            /* Each row is added as a new array */
            $locations[] = array('id_geo' => $row['id_geo'], 'nama_geo' => $name, 'lat' => $latitude, 'lng' => $longitude, 'lnk' => $link, 'image' => $gambar);
        }
        //echo $locations[0]['name'].": In stock: ".$locations[0]['lat'].", sold: ".$locations[0]['lng'].".<br>";
        //echo $locations[1]['name'].": In stock: ".$locations[1]['lat'].", sold: ".$locations[1]['lng'].".<br>";
        ?>
        <!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDTBKmWZKOrhwfSuu7gROSV5oRxwHL_Now"></script> -->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI"></script>

        <script type="text/javascript">
            var map;
            var Markers = {};
            var infowindow;
            var locations = [
                <?php for ($i = 0; $i < sizeof($locations); $i++) {
                    $j = $i + 1; ?>[
                        'AMC Service',

                        '<p align="center"><img src="/admin/assets/img/upload/<?= $locations[$i]['image'] ?>" height="100"><br><?= $locations[$i]['nama_geo']; ?><br><br><a href="maps.php?id=<?php echo $locations[$i]['id_geo']; ?>" class="btn btn-outline-secondary btn-sm">Lihat Detail</a></p>',
                        <?php echo $locations[$i]['lat']; ?>,
                        <?php echo $locations[$i]['lng']; ?>,
                        <?php echo $locations[$i]['id_geo']; ?>
                    ] <?php if ($j != sizeof($locations)) echo ",";
                    } ?>
            ];
            var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);

            function initialize() {
                var mapOptions = {
                    zoom: 5,
                    center: origin
                };
                var iconBase = '/assets/img/';
                map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                infowindow = new google.maps.InfoWindow();
                for (i = 0; i < locations.length; i++) {
                    var position = new google.maps.LatLng(locations[i][2], locations[i][3]);
                    var marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        icon: iconBase + 'geo_marker.png'
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][1]);
                            infowindow.setOptions({
                                maxWidth: 200
                            });
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                    Markers[locations[i][4]] = marker;
                }
                locate(0);
            }

            function locate(marker_id) {
                var myMarker = Markers[marker_id];
                var markerPosition = myMarker.getPosition();
                map.setCenter(markerPosition);
                google.maps.event.trigger(myMarker, 'click');
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card border-center-primary shadow h-100 py-2">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div id="map-canvas" style="width:100%;height:450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php include_once("template/footer.php");
?>