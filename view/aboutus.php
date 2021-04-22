<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<br><br><br><br><br><br><br><br><br><br><br>

</section>
<section class="info-container">
<div class="sport-container">
        <?php
        $home = Admin::overTXT();

        echo "<h2>".$home['titel']."</h2>"."<h3>".$home['tussenkopje']."</h3>"."<p>".$home['home']."</p>";
        ?>
        <span></span>
    </div>
    </section>

<?php
include_once "includes/footer.php";
?>

</html>

