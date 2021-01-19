<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: index.php');
}
include_once "view/includes/header.php";
//-------------< user level check functie  >-----------------|
//haalt user level op uit admin                            //|
// < 5 alleen admins kunnen op deze pagina                 //|
// < 4 betekend dat docenten en admins op pagina kunnen    //|
// < 3 studenten en meer kunnen op deze pagina             //|
// < 2 gasten kunnen de pagina bekijken                    //|
// < 1 alleen een geldig acount kan deze pagina zien       //|
if($_SESSION['user_lv'] < 1){                              //|
    header('Location: index.php');                         //|
}                                                          //|
//-----------------------------------------------------------|
?>

<body>
<div class="txthome-container">
    <?php
    $id = $_SESSION['uid'];
    $user = Admin::downloadUser($id);

    $username = $user['username'];
    $voornaam = $user['voornaam'];
    $achternaam = $user['achternaam'];
    $email = $user['email'];
    $straat = $user['straat'];
    $plaats = $user['plaats'];
    $postcode = $user['postcode'];
    $mobiel = $user['mobiel'];
    $website = $user['website'];
    ?>

    <div>
        <div class="txthome-main">
            <h1>Mijn Gegevens</h1>
            <h3>Hier kunt u uw eigen gegevens wijzigen. Wij raden u aan om dit formulier zo compleet mogelijk in te vullen, dit in verband met uw bereikbaarheid</h3>
        </div>
        <div class="txthome-sub">
            <p>Gegevens</p>
        </div>
    </div>

    <form method="post">
        <label>
            Username<br>
            <?php
            echo "<input class='titel' type='text' name='username' value='$username'>"
            ?>
        </label><br>
        <label>
            Voornaam<br>
            <?php
            echo "<input class='titel' type='text' name='voornaam' value='$voornaam'>"
            ?>
        </label><br>
        <label>
            Achternaam <br>
            <?php
            echo "<input class='titel' type='text' name='achternaam' value='$achternaam'>"
            ?>
        </label><br>
        <label>
            E-mail <br>
            <?php
            echo "<input class='titel' type='text' name='email' value='$email'>"
            ?>
        </label><br>
        <label>
            Straat <br>
            <?php
            echo "<input class='titel' type='text' name='straat' value='$straat'>"
            ?>
        </label><br>
        <label>
            Plaats <br>
            <?php
            echo "<input class='titel' type='text' name='plaats' value='$plaats'>"
            ?>
        </label><br>
        <label>
            Postcode <br>
            <?php
            echo "<input class='titel' type='text' name='postcode' value='$postcode'>"
            ?>
        </label><br>
        <label>
            Mobiel <br>
            <?php
            echo "<input class='titel' type='text' name='mobiel' value='$mobiel'>"
            ?>
        </label><br>
        <label>
            Website <br>
            <?php
            echo "<input class='titel' type='text' name='website' value='$website'>"
            ?>
        </label><br>

        <input class="submit" type="submit" name="edit-user" value="Wijzig">
    </form>
</div>
</body>

</html>
