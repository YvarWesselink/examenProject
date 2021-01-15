<!DOCTYPE html>
<html lang="en">
<?php
include_once 'view/includes/header.php';
if (empty($_SESSION['username'])) {
    header('Location: index.php');
    $username = $_SESSION['username'];
}

if (isset($_POST["album-weergeven"])) {
    $album = $_POST['album'];
}
?>

<div class="txthome-container">
    <div>
        <div class="txthome-main">
            <h1>Album</h1>
            <h3>Bekijk het album <?php echo $album?>.</h3>
        </div>
        <div class="txthome-sub">
            <p>Foto's</p>
        </div>

        <div class="images">
            <?php Admin::downloadAlbumImages($album) ?>
        </div>
    </div>
</div>

</html>
