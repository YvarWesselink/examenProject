<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<br><br><br><br><br><br><br><br><br><br><br>

<div class="txthome-container opdracht">
    <div class="txthome-main">
        <h1>Opdrachten Indienen</h1>
        <h3>Voer hier uw gegevens in voor de opdracht die u wilt inleveren.</h3>
    </div>
    <!-- Dit is het form waar je de opdracht in kunt vullen. -->
    <div class="txthome-sub">
        <p>1 Opdracht </p>
    </div>


    <form method="post" class="opdrachtIndienenForm" >
        <div>
            <?php
            $errormsg = "";
            if (isset($_POST['sendExcersise'])) {
                $errormsg = excersises::checkExcersise($_POST);

                if (!array_filter($errormsg)) {
                    excersises::UploadExersise($_POST);
                }
            }
            excersises::showFields($errormsg);
            ?>
            <!-- Dit is het form voor de gegevens van het bedrijf. -->
            <label>
                Hierbij gaat u akkoord met de <a href="voorwaarden" target="_blank">algemene voorwaarden</a>.
                <input type="checkbox" name="checkbox" value="check"/>
            </label><br>
            <input type="submit" class="sendExcersiseBtn" name="sendExcersise" value="Opdracht aanmaken">
    </form>
</div>
</html>
