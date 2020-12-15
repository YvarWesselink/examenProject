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
                    <img src="/public/img/group.png">
                </div>
                <div class="button-bot">
                    <p>Gebruikers Beheer</p>
                </div>
            </div>
        </a>

        <a href="/#" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/database.png">
                </div>
                <div class="button-bot">
                    <p>Database Pagina</p>
                </div>
            </div>
        </a>

        <a href="/#" class="admin-button">
            <div>
                <div class="button-top">
                    <img src="/public/img/editopdracht.png">
                </div>
                <div class="button-bot">
                    <p>Opdracht formulier aanpassen</p>
                </div>
            </div>
        </a>
    </div>

    <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>

</body>
</html>


