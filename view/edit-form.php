<!DOCTYPE html>
<html lang="en">
<?php
include_once 'view/includes/header.php';
if (empty($_SESSION['username'])) {
    header('Location: index.php');
    $username = $_SESSION['username'];
}
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
            <input class="submit-form" type="submit" name="update">
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
            <input class="submit-form" type="submit" name="update">
            <input type="hidden" name="type" value="contactbedrijfgegevens">
        </form>
    </div>
</div>
</body>

</html>