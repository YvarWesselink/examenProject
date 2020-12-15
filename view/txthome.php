<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: index.php');
}
include_once "view/includes/header.php";
?>

<body>
    <div>
        <form>

        </form>
    </div>
</body>

</html>


