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
<form method="post" action="" enctype='multipart/form-data' class="upload-image">
    <input type='file' name='file'/>
    <input type='submit' value='Save name' name='but_upload'>
</form>
</body>

<div class="txthome-container">
    <div>
        <div class="txthome-main">
            <h1>Foto's Uploaden</h1>
            <h3>Hier kunt u foto's uploaden.</h3>
        </div>
        <div class="txthome-sub">
            <p>Foto's</p>
        </div>
        <p>Upload hier een foto en kies daarna uit een van de aangemaakte albums, wilt u de foto plaatsen in een nieuw album? Maak dan een nieuw album aan bij het blokje "Album Uploaden" hieronder.</p><br>
    </div>

    <form method="post" action="" enctype='multipart/form-data' class="upload-image">
        <ol>
            <li>
                <input type='file' name='file' id="imgInp"/><br>
            </li>
            <li>
                <label>
                    Kies album
                    <select name="album">
                        <?php
                        Admin::downloadAlbums();
                        ?>
                    </select>
                </label>
            </li>
        </ol>
        <br>
        <input class="uploadfotobut" type='submit' value='Upload Plaatje' name='but_upload'>
    </form>

    <br>

    <div>
    </br>
        <div class="txthome-sub">
            <p>Album Uploaden</p>
        </div>
        <p>Wilt u een nieuw album toe voegen om foto's in te zetten? Vul dan de naam van het album in en kies de school waar dit album voor is bedoelt. Klik dan op "Uplaod" om een leeg album te uploaden.</p><br>

        <form method="post">
            <ol>
                <li>
                    <input type="text" name="naam" placeholder="naam van het album"><br>
                </li>
                <li>
                    <label>
                        Kies School
                        <select name="school">
                            <option value="s">Salland</option>
                            <option value="z">Zwolle</option>
                        </select>
                    </label><br>
                </li>
            </ol><br>
            <input class="uploadfotobut" type="submit" value="Upload Album" name="albums">
        </form>
        <br />
        <br>
    </div>

    <div class="albums">
        <div class="txthome-sub">
            <p>Albums</p>
        </div>
        <p>Bekijk hier uw aangemaakte albums. Vanuit dit menu kunt u ook albums verwijderen (let op, verwijderd u een album worden alle foto's ook verwijderd!)</p><br>
        <div>
            <?php
            Admin::downloadFotos();
            ?>
        </div>
        <br><br>
    </div>
</div>

</html>
