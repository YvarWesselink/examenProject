<?php
// creëer hier je routes
// 1. Zorg dat je een controller aanmaakt voor je pagina en zet deze in de map 'controller'. Zorg er ook voor dat je de class een extends controller geeft.
// 2. Maak een php bestand aan waarin je de html schrijft voor je pagina en zet deze in de map 'view'.
//
// Route::set("*De naam van je route*", function() {
//     *1. Controller van de pagina*::CreateView("*de naam van php bestand voor je view*")
// });
//
// *VOORBEELD*
//
// ik wil een pagina 'overons' maken:
//
//  1. ik heb de controller 'overons.php' aangemaakt en in de map 'controller' gezet.
//  2. ik heb het php bestand 'overons.php' aangemaakt en in de map 'view' gezet.
//
// Route::set('overons', function () {
//     overons::CreateView('overons');
// });
//
// Daarna kun je functies voor deze pagina in de controller 'overons.php' zetten die in het mapje controller staat.
// De html code kun je dan in de 'overons.php' zetten die in het mapje view staat.
//
// Als je een functie aan wilt roepen


Route::set('index.php', function () {
    Index::CreateView('Index');
});

Route::set('zwolle', function () {
    Index::CreateView('zwolle');
});

Route::set('salland', function () {
    Index::CreateView('salland');
});

Route::set('opdrachten', function () {
    excersises::CreateView('excersises');
});

Route::set('opdrachten-formulier', function () {
    excersises::CreateView('excersisesDb');
});

Route::set('oude-opdrachten', function () {
    oudeOpdrachten::CreateView('oudeOpdrachten');
});

Route::set('update-opdracht', function () {
    session_start();
    if (isset($_POST['editBtn'])) {
        $_SESSION['id'] = $_POST['project_id'];
    }    
    updateExcersise::CreateView('updateExcersise');
});

Route::set('update-opdracht-zwolle', function () {
    session_start();
    if (isset($_POST['editBtnZ'])) {
        $_SESSION['id'] = $_POST['project_id'];
    }
    updateExcersiseZ::CreateView('updateExcersiseZ');
});

Route::set('update-gebruiker', function () {
    session_start();
    if (isset($_POST['editBtn'])) {
        $_SESSION['id'] = $_POST['uid'];
    }
    updateUsers::CreateView('updateUsers');
});

Route::set('update-nieuws', function () {
    session_start();
    if (isset($_POST['editBtn'])) {
        $_SESSION['id'] = $_POST['userID'];
    }
    updateNews::CreateView('updateNews');
});

Route::set('update-oude-opdracht', function () {
    session_start();
    if (isset($_POST['editBtn'])) {
        $_SESSION['id'] = $_POST['project_id'];
    }    
    updateOldExcersise::CreateView('updateOldExcersise');
});

Route::set('aboutus', function () {
    aboutus::CreateView('aboutus');
});

Route::set('registreren', function () {
    login::CreateView('registreren');
});

Route::set('login', function () {
    login::CreateView('login');
});

Route::set('contact', function () {
    Contact::CreateView('contact');
});

Route::set('voorwaarden', function () {
    Voorwaarden::CreateView('voorwaarden');
});

Route::set('adminpanel', function () {
    Admin::CreateView('adminpanel');
});

Route::set('txthome', function () {
    Admin::CreateView('txthome');
});

Route::set('acgegevens', function () {
    Admin::CreateView('acgegevens');
});

Route::set('logout', function () {
    Admin::logout();
});

Route::set('formulier', function () {
    Admin::CreateView('edit-form');
});

Route::set('userlevel', function () {
    Index::CreateView('userlevel');
});

Route::set('viewdb', function () {
    viewdb::CreateView('viewdb');
});

Route::set('deleteRowOp', function() {
    Admin::deleteElementOp($_GET['id']);
});

Route::set('deleteRowCo', function() {
    Admin::deleteElementCo($_GET['id']);
});

Route::set('deleteRowVe', function () {
    Admin::deleteElementVe($_GET['id']);
});

Route::set('deleteRowExc', function() {
    Admin::deleteElementExc($_GET['id']);
});

Route::set('deleteRowExcZ', function() {
    Admin::deleteElementExcZ($_GET['id']);
});

Route::set('deleteRowUser', function() {
    Admin::deleteElementUser($_GET['id']);
});

Route::set('deleteRowNews', function() {
    Admin::deleteElementNews($_GET['id']);
});

Route::set('deleteRowOldExc', function() {
    Admin::deleteElementOldExc($_GET['id']);
});

Route::set('foto-uploaden', function () {
    Admin::CreateView('uploadImage');
});

Route::set('alle_nieuws', function () {
    Index::CreateView('alle_nieuws');
});

Route::set('nieuws', function () {
    Index::CreateView('nieuws');
});


Route::set('album-weergeven', function () {
    Index::CreateView('albumWeergeven');
});


Route::set('fotos', function () {
    Index::CreateView('fotos');
});

Route::set('album-weergeven-school', function () {
    Index::CreateView('albums');
});

Route::set('txtcontact', function () {
    Contact::CreateView('txtcontact');
});

Route::set('moveup', function () {
    Admin::moveUp($_GET['id']);
});

Route::set('movedown', function () {
    Admin::moveDown($_GET['id']);
});