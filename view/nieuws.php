<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php";

?>

<div class="txthome-container">
    <div>
        <div class="txthome-main">
            <h1>Nieuws Uploaden</h1>
            <h3>Hier kunt u de nieuwse nieuwtjes uploaden.</h3>
        </div>
        <div class="txthome-sub">
            <p>Nieuws</p>
        </div>
    </div>

    <div id="signup">
    <form method="post" action="" name="nieuws">
        <label>Naam:</label>
        <input type="text" name="Name" autocomplete="off" />
        <label>Email:</label>
        <input type="text" name="Email" autocomplete="off" />
        <label>Bedrijf</label>
        <input type="text" name="Company" autocomplete="off" />
        <label>Bericht</label>
        <input type="text" name="Comments" autocomplete="off"/>
<<<<<<< Updated upstream
=======
        <!-- <form method="post" action="" enctype='multipart/form-data' class="upload-image"> -->
>>>>>>> Stashed changes
        <label>Nieuws foto</label>
        <div class="images">
            <?php Admin::downloadAlbumImages($album); ?>
        </div>
        <label>
            Kies School
            <select name="school">
                <option value="z">Zwolle</option>
                <option value="s">Salland</option>
            </select>
        </label>
<<<<<<< Updated upstream
=======
        <!-- <input type='submit' value='Upload Plaatje' name='but_upload'> -->
    <!-- </form> -->
>>>>>>> Stashed changes
        <input type="submit" class="button" name="news" value="Versturen">
    </form>
</div>
    

<!--    in index.php staat op regel 108 de functie die er voor zorgt dat de data naar de database wordt gestuurd (die is nu nog leeg dus moet je zelf even invullen.)-->

</div>

<!--<formmethod="post"action="--><?//phpechohtmlspecialchars($_SERVER["PHP_SELF"]);?><!--"> <br><br><br><br><br><br><br>-->
<!--  Volledige naam: <inputtype="text"name="name"required>-->
<!--<br><br>-->
<!--  Email Adres: <inputtype="text"name="email"required>-->
<!--<br><br>-->
<!--  Bedrijfsnaam*: <inputtype="text"name="company">-->
<!--<br><br>-->
<!--  Bericht: <textareaname="comments"rows="5"cols="40"required></textarea>-->
<!--<br><br>-->
<!--<inputtype="submit"name="submit"value="Submit">-->
<!--</form>-->

</html>
