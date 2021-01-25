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
if($_SESSION['user_lv'] < 5){                              //|
    header('Location: index.php');                         //|
}                                                          //|
//-----------------------------------------------------------|
?>

<body>
    <div class="txtcontact-container">
        <?php
        $contact = Admin::contactTXT();
        $straat = $contact['straat'];
        $penp = $contact['penp'];
        $email = $contact['email'];
        $telnmr = $contact['telnmr'];
        ?>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div>
            <div class="txtcontact-main">
                <h1>Tekst Contact Aanpassen</h1>
                <h3>Hier kunt u de gegevens wijzigen van de contact pagina.</h3>
            </div>
            <div class="txtcontact-sub">
                <p>Contact pagina</p>
            </div>
        </div>

        <form method="post">
            <label>
                Straat<br>
                <?php
                echo "<input class='titel' type='text' name='straat' value='$straat'>"
                ?>
            </label><br>
            <label>
                Plaats en postcode<br>
                <?php
                echo "<textarea class='titel' name='penp'>$penp</textarea>"
                ?>
            </label><br>
            <label>
                Email<br>
                <?php
                echo "<textarea class='titel' name='email'>$email</textarea>"
                ?>
            </label><br>
            <label>
                Telefoon nummer<br>
                <?php
                echo "<input class='titel' type='text' name='telnmr' value='$telnmr'>"
                ?>
            </label><br>

            <input class="submit" type="submit" name="upload_contact" value="send">
        </form>
    </div>
</body>

</html>


