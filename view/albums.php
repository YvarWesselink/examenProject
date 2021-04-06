<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php";
$school = $_SESSION['school'];

if (isset($_POST["album-weergeven"])) {
    $album = $_POST['album'];
}

if (isset($_POST["album-nieuws"])) {
    $album = $_POST['album-nieuws'];
}
?>

<body>
<div class="txthome-container">
    <div>
        <div class="txthome-main">
            <h1>Foto's</h1>
            <h3>Bekijk het album <?php echo $album?>.</h3>
        </div>
        <div class="txthome-sub">
            <p>Foto's</p>
        </div>

        <div class="images">
            <?php Admin::downloadAlbumImagesSchool($album) ?>
        </div>
    </div>
</div>
</body>

</html>
