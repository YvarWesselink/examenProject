<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
$contact = Admin::contactTXT();

?>




<section class="info-container">
    <div class="sport-container">
        <h1>Contact</h1>
        <h3>Projectbureau Salland</h3>
        <p>
        <?php
         echo "<p>".$contact['straat'].
         "<br />".$contact['penp']."<br/>"
         .$contact['email']."<br/>"
         .$contact['telnmr']."</p>";
            //Passage 14 <br>
            //Raalte 8101EW <br>
            //Email projectbureausalland@landstede.nl <br>
            //Telefoon nummer: 06-12162694 <br>
            ?>
        </p>
    </div>
</section>

<?php
include_once "includes/footer.php";
?>

</html>

