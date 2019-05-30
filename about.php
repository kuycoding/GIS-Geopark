<?php !isset($_SESSION['id_user']);
session_start();
?>
<?php include_once("template/header.php"); ?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="col mr-2">
                        <div class="card text-center">
                            <img class="card-img-top rounded" src="admin/assets/img/upload/3584920170205082334_IMG_0763.JPG" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><span style="font-family: Roboto;"> APA GEOPARK?</span></h1>
                        </div>
                        <p>
                            <div style="text-align: justify;"><span style="color: rgb(102, 102, 102); font-family: Roboto; font-size: 16px;">"Taman bumi (bahasa Inggris: geopark) adalah wilayah terpadu yang terdepan dalam perlindungan dan penggunaan warisan geologi dengan cara yang berkelanjutan, dan mempromosikan kesejahteraan ekonomi masyarakat yang tinggal di sana. Terdapat istilah Taman Bumi Global serta juga Taman Bumi Nasional." (https://id.wikipedia.org/wiki/Taman_bumi)</span></div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once("template/footer.php"); ?>