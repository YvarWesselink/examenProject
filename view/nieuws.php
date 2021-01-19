<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
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

    <form method="post">
        <label>
            Email
            <input type="text">
        </label><br>
        <input type="submit" name="news">
    </form>

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
