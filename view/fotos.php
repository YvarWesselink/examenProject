<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php";
$school = $_SESSION['school'];

?>

<body>
    <div class="txthome-container">
        <div>
            <div class="txthome-main">
                <h1>Albums</h1>
                <h3>Hier kunt u foto's bekijken .</h3>
            </div>
            <div class="txthome-sub">
                <p>Albums</p>
            </div>

            <div class="albums-load">
                <?php
                Admin::downloadFotosSchool($school)
                ?>
            </div>
        </div>
    </div>
</body>

</html>


