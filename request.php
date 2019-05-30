<?php include_once("auth.php");
include_once("template/header.php");
?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
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
                            zoom: 15,
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
                <div class="col-lg-5 d-none d-lg-block">
                    <div id="map-canvas" style="width:100%;height:700px;"></div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Request</h1>
                        </div>
                        <form class="user" method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="lat" name="lat" placeholder="Latiude" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="lon" name="lon" placeholder="Longitude" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea type="text" rows="" class="form-control form-control-user" id="des" name="des" placeholder="Deskripsi" required></textarea>
                            </div>
                            <div class="form-group">
                                <textarea type="text" rows="" class="form-control form-control-user" id="info" name="info" placeholder="Informasi" required></textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input form-control form-control-user" accept="image/*" onchange="loadFile(event)" required>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <img id="output" height="100" width="100" />
                                <script>
                                    var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                </script>
                            </div>
                            <button type="submit" id="req" name="req" class="btn btn-primary btn-user btn-block">
                                Request
                            </button>
                        </form>
                        <?php
                        if (isset($_POST['req'])) {
                            $nama = $_POST['nama_geo'];
                            $lat = $_POST['lat'];
                            $lon = $_POST['lon'];
                            $des = $_POST['des'];
                            $info = $_POST['info'];
                            $userid = $_SESSION['id_user'];

                            $file = $_FILES['gambar']['name'];
                            $tmp = $_FILES['gambar']['tmp_name'];
                            $ext = pathinfo($file, PATHINFO_EXTENSION);
                            $image = rand(1000, 1000000) . $file;
                            $path = 'assets/img/upload/' . $image;
                            move_uploaded_file($tmp, $path);

                            $sql = "INSERT INTO request(nama_geo, deskripsi, info, lat, lon, gambar, id_user) VALUES('$nama','$lat','$lon','$des','$info','$image','$userid')";
                            $query = mysqli_query($con, $sql) or die(mysqli_error($con));
                            if ($query) { ?> <script>
                                    alert('Berhasil Ditambah')
                                </script>

                            <?php

                        }
                    }

                    ?>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("template/footer.php") ?>