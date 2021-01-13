<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<!-- End Navbar -->
<!-- ---------------------------- -->
<!-- Start Banner Section -->
<section class="banner">
    <div class="banner-img"></div>
    <div class="banner-svg">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                  d="M0,96L80,112C160,128,320,160,480,154.7C640,149,800,107,960,90.7C1120,75,1280,85,1360,90.7L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,128L120,112C240,96,480,64,720,64C960,64,1200,96,1320,112L1440,128L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg> -->
    </div>
</section>
<div class="clearfix"></div>
<!-- End Banner Section -->
<!-- ---------------------------- -->
<!-- Start Region Section -->
<section class="region">
    <div class="region-info">
        <?php
        $home = Admin::downloadTXT();

        echo "<h2>".$home['titel']."</h2>"."<h3>".$home['tussenkopje']."</h3>"."<p>".$home['home']."</p>";
        ?>
        <span></span>
    </div>
</section>
<div class="clearfix"></div>
<!-- End Region Section -->
<!-- ---------------------------- -->
<!-- Start Information Section -->
<section class="info">
    <div class="container">
        <div>
            <div class="child first">
                <h2>Zwolle</h2>
                <a href="#">Kies voor regio Zwolle <i class="fas fa-arrow-right icons"></i></a>
            </div>
        </div>
        <hr>
        <div>
            <div class="child last">
                <h2>Salland</h2>
                <a href="#">Kies voor regio Salland <i class="fas fa-arrow-right icons"></i></a>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<!-- End Information Section -->
<!-- ---------------------------- -->
<!-- Start Nieuws Section -->
<section class="nieuws">
    <h2>Nieuws</h2>
    <div class="timeline">
        <div class="nieuws-container left">
            <span class="icon"></span>
            <span class="date">07 NOVEMBER 2017</span>
            <div class="content">
                <h2>Hongerige zombies, sexy vampiers en angstaanjagende weerwolven komen uit de schaduw gekropen</h2>
                <a href="/nieuws">Lees meer <i class="fas fa-arrow-right icons"></i></a>
            </div>
        </div>
        <div class="nieuws-container right">
            <span class="icon"></span>
            <span class="date">27 JUNE 2017</span>
            <div class="content">
                <h2>Kidsspeelmiddag op 28 juni</h2>
                <a href="#">Lees meer <i class="fas fa-arrow-right icons"></i></a>
            </div>
        </div>
        <div class="nieuws-container left">
            <span class="icon"></span>
            <span class="date data-2">14 JUNE 2017</span>
            <div class="content">
                <h2>Groot nieuws</h2>
                <a href="#">Lees meer <i class="fas fa-arrow-right icons"></i></a>
            </div>
        </div>
    </div>
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
