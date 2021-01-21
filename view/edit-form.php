<!DOCTYPE html>
<html lang="en">
<?php
include_once 'view/includes/header.php';
if (empty($_SESSION['username'])) {
    header('Location: index.php');
    $username = $_SESSION['username'];
}
//-------------< user level check functie  >-----------------|
//haalt user level op uit admin                            //|
// < 5 alleen admins kunnen op deze pagina                 //|
// < 4 betekend dat docenten en admins op pagina kunnen    //|
// < 3 studenten en meer kunnen op deze pagina             //|
// < 2 gasten kunnen de pagina bekijken                    //|
// < 1 alleen een geldig acount kan deze pagina zien       //|
if($_SESSION['user_lv'] < 5){                              //|
    header('Location: index.php');                         //|
}                                                          //|
//-----------------------------------------------------------|
?>

<body>
<div class="txthome-container">
    <div>
        <div class="txthome-main">
            <h1>Opdracht formulier aanpassen</h1>
            <h3>Hier kunt u de gegevens wijzigen van het opdracht formulier. verwijder elementen door ze te verwijderen met de verwijder knop en voeg elementen toe door ze te schrijven in het tekstvlak</h3>
        </div>

        <!-- Formulier toevoegen -->
        <div class="txthome-sub">
            <p>Opdracht</p>
            <div class="add-form-1">+</div>
        </div>

        <form method="post" class="form-1">
            <?php
            echo Admin::getElementsForm();
            ?>
            <input class="submit-form-1" type="submit" name="update">
            <input type="hidden" name="type" value="projectenopdrachten">
        </form>

        <!-- Contact/Bedrijfgegevens toevoegen -->
        <div class="txthome-sub">
            <p>Contact/Bedrijfgegevens</p>
            <div class="add-form-2">+</div>
        </div>

        <form method="post" class="form-2">
            <?php
            echo Admin::getElementsFormCont();
            ?>
            <input class="submit-form-2" type="submit" name="update">
            <input type="hidden" name="type" value="contactbedrijfgegevens">
        </form>

        <!-- Verborgen waarden toevoegen -->
        <div class="txthome-sub">
            <p>Verborgen Waarden</p>
            <div class="add-form-4">+</div>
        </div>

        <form method="post" class="form-3">
            <?php
            echo Admin::getElementsFormVerb();
            ?>
            <input class="submit-form-3" type="submit" name="update">
            <input type="hidden" name="type" value="verborgenwaarden">
        </form>
    </div>
</div>
</body>

</html>