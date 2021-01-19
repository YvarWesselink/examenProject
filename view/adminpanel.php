<!DOCTYPE html>
<html lang='en'>
<?php
include_once 'view/includes/header.php';
if (empty($_SESSION['username'])) {
    header('Location: index.php');
    $username = $_SESSION['username'];
}

//-------------< user level check functie  >-----------------|
//haalt user level op uit admin                            //|
// < 5 alleen admins kunnen op deze pagina                 //|
// < 4 betekend dat docenten en admins op pagina kunnen    //|
// < 3 studenten en meer kunnen op deze pagina             //|
// < 2 gasten kunnen de pagina bekijken                    //|
// < 1 alleen een geldig acount kan deze pagina zien       //|
if($_SESSION['user_lv'] < 0){                              //|
    header('Location: index.php');                         //|
}                                                          //|
//-----------------------------------------------------------|
?>

<body>
<div class='admin-container'>
<?php
 if($_SESSION['user_lv'] == 1){
    echo"
        <a href='/acgegevens' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/user.png'>
                </div>
                <div class='button-bot'>
                    <p>Mijn gegevens</p>
                </div>
            </div>
        </a>

        <a href='/logout' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/logout.png'>
                </div>
                <div class='button-bot'>
                    <p>Log Uit</p>
                </div>
            </div>
        </a>
    ";
 }elseif($_SESSION['user_lv'] == 2){
    echo"
    <a href='/acgegevens' class='admin-button'>
    <div>
        <div class='button-top'>
            <img src='/public/img/user.png'>
        </div>
        <div class='button-bot'>
            <p>Mijn gegevens</p>
        </div>
    </div>
</a>

<a href='/logout' class='admin-button'>
    <div>
        <div class='button-top'>
            <img src='/public/img/logout.png'>
        </div>
        <div class='button-bot'>
            <p>Log Uit</p>
        </div>
    </div>
</a>
    ";
 }elseif($_SESSION['user_lv'] == 3){
    echo"
    <a href='/acgegevens' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/user.png'>
                </div>
                <div class='button-bot'>
                    <p>Mijn gegevens</p>
                </div>
            </div>
        </a>

        <a href='/logout' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/logout.png'>
                </div>
                <div class='button-bot'>
                    <p>Log Uit</p>
                </div>
            </div>
        </a>

        <a href='/opdrachten-formulier' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/database.png'>
                </div>
                <div class='button-bot'>
                    <p>Database Pagina</p>
                </div>
            </div>
        </a>
    ";
 }elseif($_SESSION['user_lv'] == 4){
    echo"
    <a href='/acgegevens' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/user.png'>
                </div>
                <div class='button-bot'>
                    <p>Mijn gegevens</p>
                </div>
            </div>
        </a>

        <a href='/logout' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/logout.png'>
                </div>
                <div class='button-bot'>
                    <p>Log Uit</p>
                </div>
            </div>
        </a>
        
        <a href='/opdrachten-formulier' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/database.png'>
                </div>
                <div class='button-bot'>
                    <p>Database Pagina</p>
                </div>
            </div>
        </a>

    <a href='/foto-uploaden' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/logout.png'>
                </div>
                <div class='button-bot'>
                    <p>Foto's Uploaden</p>
                </div>
            </div>
        </a>
    ";
 }elseif($_SESSION['user_lv'] == 5){
    echo"
    <a href='/acgegevens' class='admin-button'>
    <div>
        <div class='button-top'>
            <img src='/public/img/user.png'>
        </div>
        <div class='button-bot'>
            <p>Mijn gegevens</p>
        </div>
    </div>
</a>

<a href='/logout' class='admin-button'>
    <div>
        <div class='button-top'>
            <img src='/public/img/logout.png'>
        </div>
        <div class='button-bot'>
            <p>Log Uit</p>
        </div>
    </div>
</a>

<a href='/opdrachten-formulier' class='admin-button'>
    <div>
        <div class='button-top'>
            <img src='/public/img/database.png'>
        </div>
        <div class='button-bot'>
            <p>Database Pagina</p>
        </div>
    </div>
</a>

<a href='/foto-uploaden' class='admin-button'>
    <div>
        <div class='button-top'>
            <img src='/public/img/logout.png'>
        </div>
        <div class='button-bot'>
            <p>Foto's Uploaden</p>
        </div>
    </div>
</a>

         <a href='/nieuws' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/editopdracht.png'>
                </div>
                <div class='button-bot'>
                    <p>Nieuws Uploaden</p>
                </div>
            </div>
        </a>
        
        <a href='/txthome' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/edit.png'>
                </div>
                <div class='button-bot'>
                    <p>Text Home Aanpassen</p>
                </div>
            </div>
        </a>

        <a href='/userlevel' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/group.png'>
                </div>
                <div class='button-bot'>
                    <p>Gebruikers Beheer</p>
                </div>
            </div>
        </a>

        <a href='/formulier' class='admin-button'>
            <div>
                <div class='button-top'>
                    <img src='/public/img/editopdracht.png'>
                </div>
                <div class='button-bot'>
                    <p>Formulier aanpassen</p>
                </div>
            </div>
        </a>
    ";
 }else{
    echo"
    <a href='/logout' class='admin-button'>
        <div>
            <div class='button-top'>
                <img src='/public/img/logout.png'>
            </div>
            <div class='button-bot'>
                <p>Log Uit</p>
            </div>
        </div>
    </a>
";
 }
?>
</div>
    <!--<div class='royalties'>Icons made by <a href='https://www.flaticon.com/authors/freepik' title='Freepik'>Freepik</a> from <a href='https://www.flaticon.com/' title='Flaticon'>www.flaticon.com</a></div>-->

</body>
</html>


