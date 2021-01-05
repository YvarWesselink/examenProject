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

Route::set('opdrachten', function () {
    excersises::CreateView('excersises');
});

Route::set('aboutus', function () {
    aboutus::CreateView('aboutus');
//    aboutus::test();
});

Route::set('registreren', function () {
    login::CreateView('registreren');
});

Route::set('inloggen', function () {
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

Route::set('userlevel', function () {
    Index::CreateView('userlevel');
});
