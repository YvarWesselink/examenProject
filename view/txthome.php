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
        $hometxt = $home['home'];

        $salland = Admin::sallandTXT();
        $titels = $salland['titels'];
        $tussens = $salland['tussens'];
        $sallandtxt = $salland['sallandtxt'];

        $zwolle = Admin::zwolleTXT();
        $titelz = $zwolle['titelz'];
        $tussenz = $zwolle['tussenz'];
        $zwolletxt = $zwolle['zwolletxt'];

        $overons = Admin::overTXT();
        $titelO = $overons['titel'];
        $tussenO = $overons['tussenkopje'];
        $overtxt = $overons['home'];
        ?>

        <div>
            <div class="txthome-main">
                <h1>Tekst Op De Homepagina's Aanpassen</h1>
                <h3>Hier kunt u de gegevens wijzigen van de home pagina's </h3>
            </div>
            <div class="txthome-sub">
                <p>Voorpagina</p>
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
                Inhoud tekst </br>
                <?php
                echo "<textarea class='hometxt' name='hometxt'>$hometxt</textarea>"
                ?>
            </label><br>

            <input class="submit" type="submit" name="upload" value="send">
        </form>

        <div class="txthome-sub">
            <p>Zwolle Homepagina</p>
        </div>

        <form method="post">
            <label>
                Titel Zwolle<br>
                <?php
                echo "<input class='titel' type='text' name='titelz' value='$titelz'>"
                ?>
            </label><br>
            <label>
                Tussenkopje (optioneel) <br>
                <?php
                echo "<textarea class='tussenkopje' name='tussenz'>$tussenz</textarea>"
                ?>
            </label><br>
            <label>
                Inhoud tekst <br>
                <?php
                echo "<textarea class='hometxt' name='zwolletxt'>$zwolletxt</textarea>"
                ?>
            </label><br>

            <input class="submit" type="submit" name="uploadzwolle" value="send">
        </form>

        <div class="txthome-sub">
            <p>Salland Homepagina</p>
        </div>

        <form method="post">
            <label>
                Titel Salland<br>
                <?php
                echo "<input class='titel' type='text' name='titels' value='$titels'>"
                ?>
            </label><br>
            <label>
                Tussenkopje (optioneel) <br>
                <?php
                echo "<textarea class='tussenkopje' name='tussens'>$tussens</textarea>"
                ?>
            </label><br>
            <label>
                Inhoud tekst <br>
                <?php
                echo "<textarea class='hometxt' name='sallandtxt'>$sallandtxt</textarea>"
                ?>
            </label><br>

            <input class="submit" type="submit" name="uploadsalland" value="send">
        </form>

        <form method="post">
            <label>
                Over ons tekst<br>
                <?php
                echo "<input class='titel' type='text' name='titelO' value='$titelO'>"
                ?>
            </label><br>
            <label>
                Tussenkopje (optioneel) <br>
                <?php
                echo "<textarea class='tussenkopje' name='tussenO'>$tussenO</textarea>"
                ?>
            </label><br>
            <label>
                Inhoud tekst <br>
                <?php
                echo "<textarea class='hometxt' name='overtxt'>$overtxt</textarea>"
                ?>
            </label><br>

            <input class="submit" type="submit" name="uploadoverons" value="send">
        </form>
       
      

    </div>
</body>

</html>


