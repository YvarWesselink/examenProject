<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$_SESSION['school'] = "zwolle";
include_once "includes/header.php";
?>

<style>
    .kijk_meer{
        display: block;
        margin: 50px auto 0;
        background: transparent;
        color: #005a81;
        text-align: center;
        padding: 15px 25px;
        border: 1px solid #005a81;
        border-radius: 3px;
        cursor: pointer;
        }

        .kijk_meer i{
            color: #005a81;
            -webkit-transition: padding .3s ease-in-out;
            -moz-transition: padding .3s ease-in-out;
            -o-transition: padding .3s ease-in-out;
            transition: padding .3s ease-in-out;
        }

        .kijk_meer:hover i{
            padding-left: 10px;
        }
</style>

<!-- End Navbar -->
<!-- ---------------------------- -->
<!-- Start Banner Section -->
<section class="banner">
    <section class="banner">
        <div class="banner-img">
            <div class="banner-svg">
                <div class="slider">
                    <?php
                    Admin::downloadFotosSlide();
                    ?>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.slider').slick({
                    dots: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    autoplay: true,
                    autoplaySpeed: 1700,
                });
            });

        </script>
    </section>
</section>
<div class="clearfix"></div>
<!-- End Banner Section -->


<!-- ---------------------------- -->
<!-- Start Region Section -->
<section class="region">
    <div class="region-info">
    <?php
    $zwolle = Admin::zwolleTXT();

    echo "<h2>".$zwolle['titelz']."</h2>"."<h3>".$zwolle['tussenz']."</h3>"."<p>".$zwolle['zwolletxt']."</p>";
    ?>
    <br>
        <span style="color: red; font-size: 14px;"></span>
    </div>
</section>
<div class="clearfix"></div>
<!-- End Region Section -->
<!-- ---------------------------- -->
<!-- Start Nieuws Section -->

<?php
    $school = $_SESSION['school'];
    $nieuwsContent = Admin::downloadNieuwsHome($school);

    if (count($nieuwsContent) == 0) {
        $nieuwsContent = null;
    }
    
?>

<section class="nieuws">
    <h2>Nieuws</h2>
    <div class="timeline">
        <div class="all-content">
            <div class="nieuws-container left">
                <span class="icon"></span>
                <span class="date">07 NOVEMBER 2017</span>
                <div class="content">
                    <?php
                    
                        if (isset($nieuwsContent[0]['Comments'])) {

                            $nieuwsCon = $nieuwsContent[0]['Comments'];
                            echo '<h2>' . $nieuwsCon . '</h2>';
                            echo '<a href="#">Lees meer <i class="fas fa-arrow-right icons"></i></a>';
                        
                        }else {
                            
                            echo "<h2 style='margin-bottom: 28px;'>Nog geen nieuws toegevoegd!</h2>";
                        }
                    
                    ?>
                </div>
            </div>
            <div class="image">
                <?php

                    if(isset($nieuwsContent[0]['foto'])){

                        $nieuwsFoto = $nieuwsContent[0]['foto'];

                        // get album from selected image
                        $pdo = Database::connect();
                        $st = $pdo->prepare("SELECT album FROM images WHERE image=:image");
                        $st->bindParam(":image", $nieuwsFoto);
                        $st->execute();
                        $album = $st->fetch(PDO::FETCH_ASSOC);
                        $album = $album['album'];
                    }

                    if (isset($nieuwsContent[0]['foto']) && $nieuwsFoto !== '0') {

                        $foto = $nieuwsContent[0]['foto'];

                        echo "<form method='post' action='/album-weergeven-school'>";
                        echo "<input class='nieuws-image' type='image' src='$foto' alt='image'>";
                        echo "<input type='hidden' name='album-nieuws' value='$album'>";
                        echo "</form>";
                    
                    }else {
                        
                        echo "<p style='text-decoration: underline;'>Nog geen foto!</p>";
                    }

                ?>
            </div>
        </div>
        <div class="all-content">
            <div class="nieuws-container right">
                <span class="icon"></span>
                <span class="date">27 JUNE 2017</span>
                <div class="content">
                    <?php
                    
                        if (isset($nieuwsContent[1]['Comments'])) {

                            $nieuwsCon = $nieuwsContent[1]['Comments'];
                            echo '<h2>' . $nieuwsCon . '</h2>';
                            echo '<a href="#">Lees meer <i class="fas fa-arrow-right icons"></i></a>';
                        
                        }else {
                            
                            echo "<h2 style='margin-bottom: 28px;'>Nog geen nieuws toegevoegd!</h2>";
                        }
                    
                    ?>
                </div>
            </div>
            <div class="image img-left">
                <?php

                    if(isset($nieuwsContent[1]['foto'])){

                        $nieuwsFoto = $nieuwsContent[1]['foto'];

                        // get album from selected image
                        $pdo = Database::connect();
                        $st = $pdo->prepare("SELECT album FROM images WHERE image=:image");
                        $st->bindParam(":image", $nieuwsFoto);
                        $st->execute();
                        $album = $st->fetch(PDO::FETCH_ASSOC);
                        $album = $album['album'];
                        
                    }
                    
                    if (isset($nieuwsContent[1]['foto']) && $nieuwsFoto !== '0') {

                        $foto = $nieuwsContent[1]['foto'];
                        echo "<form method='post' action='/album-weergeven-school'>";
                        echo "<input class='nieuws-image' type='image' src='$foto' alt='image'>";
                        echo "<input type='hidden' name='album-nieuws' value='$album'>";
                        echo "</form>";
                    
                        $nieuwsFoto = $nieuwsContent[1]['foto'];
                    
                    } else {
                        
                        echo "<p style='text-decoration: underline;'>Nog geen foto!</p>";
                    }
                
                ?>
            </div>
        </div>
        <div class="all-content">
            <div class="nieuws-container left">
                <span class="icon"></span>
                <span class="date data-2">14 JUNE 2017</span>
                <div class="content">
                    <?php
                    
                        if (isset($nieuwsContent[2]['Comments'])) {

                            $nieuwsCon = $nieuwsContent[2]['Comments'];
                            echo '<h2>' . $nieuwsCon . '</h2>';
                            echo '<a href="#">Lees meer <i class="fas fa-arrow-right icons"></i></a>';
                        
                        }else {
                            
                            echo "<h2 style='margin-bottom: 28px;'>Nog geen nieuws toegevoegd!</h2>";
                        }
                
                    ?>
                </div>
            </div>
            <div class="image">
                <?php

                    if(isset($nieuwsContent[2]['foto'])){

                        $nieuwsFoto = $nieuwsContent[2]['foto'];

                    }
                                            
                    if (isset($nieuwsContent[2]['foto']) && $nieuwsFoto !== '0') {

                        $foto = $nieuwsContent[2]['foto'];
                        echo "<form method='post' action='/album-weergeven-school'>";
                        echo "<input class='nieuws-image' type='image' src='$foto' alt='image'>";
                        echo "<input type='hidden' name='album-nieuws' value='$album'>";
                        echo "</form>";
                    
                        $nieuwsFoto = $nieuwsContent[2]['foto'];
                    
                    }else {
                        
                        echo "<p style='text-decoration: underline;'>Nog geen foto!</p>";
                    }
                    
                ?>
            </div>
        </div>
    </div>
    <?php

        if (count($nieuwsContent) > 3) {
            echo '<form method="POST" action="/nieuws-weergeven"><button type="submit" name="nieuws-weergeven-zwolle" class="kijk_meer">Kijk meer <i class="fas fa-arrow-right icons"></i></button></form>';
        }

    ?>
    
</section>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9f9f9" fill-opacity="1" d="M0,192L120,176C240,160,480,128,720,122.7C960,117,1200,139,1320,149.3L1440,160L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path></svg>
<div class="clearfix"></div>
<!-- End Nieuws Section -->
<!-- ---------------------------- -->
<!-- Start Foto's Section -->
<!--<section class="fotos">-->
<!--    <h2>Foto's Album</h2>-->
<!--    <div class="fotos-sec">-->
<!--        <div class="fotos-childs">-->
<!--            <div class="childs first-child">-->
<!--                <div class="album-img">-->
<!--                    <img src="/public/img/foto1.png" alt="">-->
<!--                </div>-->
<!--                <div class="child-info">-->
<!--                    <h2>Side Event Epe</h2>-->
<!--                    <a href="#">Bekijk <i class="fas fa-arrow-right icons"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="fotos-childs">-->
<!--            <div class="childs second-child">-->
<!--                <div class="album-img">-->
<!--                    <img src="/public/img/foto2.png" alt="">-->
<!--                </div>-->
<!--                <div class="child-info">-->
<!--                    <h2>Schoolfeest Rijssen</h2>-->
<!--                    <a href="#">Bekijk <i class="fas fa-arrow-right icons"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--    <div class="fotos-sec">-->
<!--        <div class="fotos-childs">-->
<!--            <div class="childs third-child">-->
<!--                <div class="album-img">-->
<!--                    <img src="/public/img/foto3.png" alt="">-->
<!--                </div>-->
<!--                <div class="child-info">-->
<!--                    <h2>Sportdag Dalfsen Hörstel</h2>-->
<!--                    <a href="#">Bekijk <i class="fas fa-arrow-right icons"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="fotos-childs">-->
<!--            <div class="childs fourth-child">-->
<!--                <div class="album-img">-->
<!--                    <img src="/public/img/foto4.png" alt="">-->
<!--                </div>-->
<!--                <div class="child-info">-->
<!--                    <h2>RIBW Activiteiten middag</h2>-->
<!--                    <a href="#">Bekijk <i class="fas fa-arrow-right icons"></i></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<div class="clearfix"></div>
<!-- End Foto's Section -->
<!-- ---------------------------- -->
<!-- Start Footer -->
<?php
include_once "includes/footer.php";
?>
<!-- End Footer -->

<script src="/public/js/main.js"></script>
</body>

</html>
