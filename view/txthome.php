<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: index.php');
}
include_once "view/includes/header.php";
?>

<body>
    <div class="txthome-container">
        <form method="post">
            <label>
                Titel<br>
                <input type="text" name="titel">
            </label><br>
            <label>
                Tussenkopje (optioneel) <br>
                <input type="text" name="tussenkop">
            </label><br>
            <label>
                home tekst <br>
                <input type="text" name="hometxt">
            </label><br>

            <input type="submit" name="upload" value="send">
        </form>
    </div>
</body>

</html>


