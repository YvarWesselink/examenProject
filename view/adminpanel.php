<!DOCTYPE html>
<html lang="en">
<?php
include_once 'view/includes/header.php';
if (empty($_SESSION['username'])) {
    header('Location: index.php');
}
?>

<body>
    <div class="admin-container">
        <a href="/Acgegevens" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/user.png">
                </div>
                <div class="button-bot">
                    <p>Mijn gegevens</p>
                </div>
            </div>
        </a>

        <a href="/txthome" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/edit.png">
                </div>
                <div class="button-bot">
                    <p>Text Home Aanpassen</p>
                </div>
            </div>
        </a>

        <a href="/#" class="admin-button">
            <div>
                <div class="button-top">

                </div>
                <div class="button-bot">
                    <p>Gebruikers Beheer</p>
                </div>
            </div>
        </a>

        <a href="/#" class="admin-button">
            <div>
                <div class="button-top">

                </div>
                <div class="button-bot">
                    <p>Database Pagina</p>
                </div>
            </div>
        </a>

        <a href="/#" class="admin-button">
            <div>
                <div class="button-top">

                </div>
                <div class="button-bot">
                    <p>Opdracht formulier aanpassen</p>
                </div>
            </div>
        </a>
    </div>
</body>
</html>


