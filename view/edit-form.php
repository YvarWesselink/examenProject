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
        <div class="txthome-sub">
            <p>Formulier</p>
            <button class="add-form">+</button>
        </div>

        <form method="post" class="form">

        </form>
    </div>
</div>
</body>

</html>