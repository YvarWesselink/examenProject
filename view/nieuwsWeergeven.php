<!DOCTYPE html>
<html lang="en">

<?php

include_once "includes/header.php";

if (isset($_POST["nieuws-weergeven-zwolle"])) {
    
    session_start();
    $_SESSION['school'] = "z";
    $nieuws = $_SESSION['school'];

}elseif (isset($_POST["nieuws-weergeven-salland"])){

    session_start();
    $_SESSION['school'] = "s";
    $nieuws = $_SESSION['school'];

}

?>
<style>
    .nieuws-container:first-of-type{
        margin-top: 1%;
    }
    .left:first-of-type{
        margin-top: 1%;
    }

    .content div{
        position: relative;
        overflow: hidden;
    }

    .content span{
        font-weight:
        bold; margin: 10px 15px;
        color: #ED138D;
        width: 12%;
        float: left;
    }

    .content p{
        margin: 10px 15px;
        width: 70%;
        float: left;
    }

</style>
<!-- End Navbar -->
<!-- ---------------------------- -->
<!-- Start Banner Section -->
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
<div class="clearfix"></div>
<!-- End Banner Section -->
<!-- ---------------------------- -->
<!-- Start Nieuws Section -->

<?php
    $school = $_SESSION['school'];
    $nieuwsContent = Admin::downloadNieuwsHome($school);

    if (count($nieuwsContent) == 0) {
        $nieuwsContent = null;
    }

        $pdo = self::connect();

        $school = $school[0];

        $st = $pdo->prepare("SELECT * FROM feedback WHERE school = :school ORDER BY userID");
        $st->bindParam(":school", $school);
        $st->execute();
    
    if ($st->rowCount() > 0){

      $row = $st->fetchAll(PDO::FETCH_ASSOC);
      $count = count($row);
      $i = 0;

      echo '<section class="nieuws">
                <h2>Nieuws</h2>
                <div class="timeline">';
      
      while($count > $i){
        
        echo '<div class="all-content">
                <div class="nieuws-container left" style="margin: 1% 0;">
                <span class="icon"></span>
                    <div class="content">
                    ';
                    ?>
                        <?php
                        
                            if (!isset($row[$i]['Name']) || !isset($row[$i]['Comments'])) {

                                echo "<h2 style='margin-bottom: 28px;'>Nog geen nieuws toegevoegd!</h2>";
                            
                            }else{
                                echo '<div><span>Titel:</span><p>' . $row[$i]['Name'] . '</p><form method="POST" action="/nieuws-artikel"><a type="submit" name="userID" href="/nieuws-artikel?artikel=' . $row[$i]['userID'] . '">Lees meer <i class="fas fa-arrow-right icons"></i></a></form></div>';
                            }
                        
                        ?>
                    <?php echo '</div>
                </div>';

                echo '<div class="image" style="margin: 2.1% 0; width: 35%; height: 250px; right: 9%;">';
                ?>
                        <?php

                            if(isset($row[$i]['foto'])){

                                $nieuwsFoto = $row[$i]['foto'];
                                
                            }

                            if (isset($row[$i]['foto']) && $nieuwsFoto !== '0') {

                                $foto = $row[$i]['foto'];
                                echo "<a href='/nieuws-artikel?artikel=" . $row[$i]['userID'] ."''><img src='$foto' alt=''/></a>";
                            
                            }else {
                                
                                echo "<p style='text-decoration: underline; padding-left: 0; margin: 0 auto; text-align: center; margin-top: 12%; font-size: 18px;'>Nog geen foto!</p>";
                            }

                        ?>
                        <?php
                            echo '</div></div>';

        $i++;

      }

        echo '</div>
            </section>';
      
        } else {

            echo "<div>Er is nog geen nieuws!</div><br>";
        }
    
?>

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
