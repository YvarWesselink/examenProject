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
    <div class="txthome-container">
        <?php
        $home = Admin::downloadTXT();
        $titel = $home['titel'];
        $tussenkopje = $home['tussenkopje'];
        $hometxt = $home['home']
        ?>

        <div>
            <div class="txthome-main">
                <h1>Tekst Home Aanpassen</h1>
                <h3>Hier kunt u de gegevens wijzigen van de home pagina.</h3>
            </div>
            <div class="txthome-sub">
                <p>Homepage</p>
            </div>
        </div>

        <form method="post">
            <label>
                Titel<br>
                <?php
                echo "<input class='titel' type='text' name='titel' value='$titel'>"
                ?>
            </label><br>
            <label>
                Tussenkopje (optioneel) <br>
                <?php
                echo "<textarea class='tussenkopje' name='tussenkop'>$tussenkopje</textarea>"
                ?>
            </label><br>
            <label>
                home tekst <br>
                <?php
                echo "<textarea class='hometxt' name='hometxt'>$hometxt</textarea>"
                ?>
            </label><br>

            <input class="submit" type="submit" name="upload" value="send">
        </form>
    </div>
</body>

</html>


