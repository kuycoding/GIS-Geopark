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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php
                            $id = $_GET['id'];
                            $query = mysqli_query($con, "SELECT * FROM data_geo WHERE id_geo = $id");

                            $data = array();
                            while ($row = mysqli_fetch_assoc($query)) {
                                $data[] = $row;
                            }
                            ?>
                            <div class="card">
                                <img class="card-img-top rounded" src="<?= "admin/assets/img/upload/" . $data[0]['image'] ?>" alt="">
                            </div>
                            <div class="card-body">
                                <h5 align="center"><?= $data[0]['nama_geo'] ?></h5>
                                <hr class="sidebar-divider">
                            </div>
                            <div class="">
                                <form method="post">
                                    <table border="0">
                                        <tr>
                                            <td style="color:#939393; font-family: 'roboto' , regular;">Informasi</td>
                                            <td> : </td>
                                            <td></td>
                                            <td style="color:#939393; font-family: 'roboto' , light;"><span><?= $data[0]['info']  ?></span></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#939393; font-family: 'roboto' , regular;">Deskripsi</td>
                                            <td> : </td>
                                            <td></td>
                                            <td style="color:#939393"><?= $data[0]['deskripsi']  ?></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#939393; font-family: 'roboto' , regular;">Latitude</td>
                                            <td> : </td>
                                            <td></td>
                                            <td style="color:#939393"><span><?= $data[0]['lat']  ?></span></td>
                                        </tr>
                                        <tr>
                                            <td style="color:#939393; font-family: 'roboto' , regular;">Longitude</td>
                                            <td> : </td>
                                            <td></td>
                                            <td style="color:#939393"><span><?= $data[0]['longitude']  ?></span></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $locations = array();
        $uname = "root";
        $pass = "";
        $servername = "localhost";
        $dbname = "gisgeopark";
        $db = new mysqli($servername, $uname, $pass, $dbname);

        //$id = $_GET['id'];
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
                    zoom: 7,
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
        <div class="col-lg-8">
            <!-- Progress Small -->
            <div class="card mb-4">
                <div class="card border-center-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $id = $_GET['id'];
                                $query = mysqli_query($con, "SELECT * FROM data_geo WHERE id_geo = $id");

                                $data = array();
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $data[] = $row;
                                }
                                ?>
                                <div class="p mb-0 font-weight-bold text-gray-800"><?= $data[0]['nama_geo']  ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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