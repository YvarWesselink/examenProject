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
    <div class="admin-container">
        <a href="/acgegevens" class="admin-button">
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

        <a href="/userlevel" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/group.png">
                </div>
                <div class="button-bot">
                    <p>Gebruikers Beheer</p>
                </div>
            </div>
        </a>

        <a href="/opdrachten-formulier" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/database.png">
                </div>
                <div class="button-bot">
                    <p>Database Pagina</p>
                </div>
            </div>
        </a>

        <a href="/formulier" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/editopdracht.png">
                </div>
                <div class="button-bot">
                    <p>Formulier aanpassen</p>
                </div>
            </div>
        </a>

        <a href="/logout" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/logout.png">
                </div>
                <div class="button-bot">
                    <p>Log Uit</p>
                </div>
            </div>
        </a>

        <a href="/foto-uploaden" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/logout.png">
                </div>
                <div class="button-bot">
                    <p>Foto's Uploaden</p>
                </div>
            </div>
        </a>
    </div>

</body>
</html>


