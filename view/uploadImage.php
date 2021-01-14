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

</html>
