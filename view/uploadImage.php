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
            <h3>Hier kunt u foto's uploaden .</h3>
        </div>
        <div class="txthome-sub">
            <p>Foto's</p>
        </div>
    </div>

    <form method="post" action="" enctype='multipart/form-data' class="upload-image">
        <input type='file' name='file' id="imgInp"/><br>
        <label>
            Kies album
            <select name="album">
                <?php
                Admin::downloadAlbums();
                ?>
            </select>
        </label><br>
        <input class="uploadfotobut" type='submit' value='Upload Plaatje' name='but_upload'>
    </form>

    <div>
    </br>
        <div class="txthome-sub">
            <p>Album Uploaden</p>
        </div>

        <form method="post">
            <input type="text" name="naam" placeholder="naam van het album"><br>
            <label>
                Kies School
                <select name="school">
                    <option value="s">Salland</option>
                    <option value="z">Zwolle</option>
                </select>
            </label><br>
            <input class="uploadfotobut" type="submit" value="upload" name="albums">
        </form>
        <br />
    </div>

    <div class="albums">
        <div class="txthome-sub">
            <p>Albums</p>
        </div>
        <div>
            <?php
            Admin::downloadFotos();
            ?>
        </div>
    </div>
</div>

</html>
