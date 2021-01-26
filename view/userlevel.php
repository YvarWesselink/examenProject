<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (empty($_SESSION['username'])) {
    header('Location: index.php');
}
//-------------< user level check functie  >-----------------|
//haalt user level op uit admin                            //|
// < 5 alleen admins kunnen op deze pagina                 //|
// < 4 betekend dat docenten en admins op pagina kunnen    //|
// < 3 studenten en meer kunnen op deze pagina             //|
// < 2 gasten kunnen de pagina bekijken                    //|
// < 1 alleen een geldig acount kan deze pagina zien       //|
if($_SESSION['user_lv'] < 4){                              //|
    header('Location: index.php');                         //|
}                                                          //|
//-----------------------------------------------------------|


include_once "view/includes/header.php";
?>

<body>
<div class="txthome-container">
<div class="txthome-main">
    <h1>Gebruikers level veranderen</h1>
<h3>
Het level van een gebruiker kan veranderd worden door op de drop down te drukken.<br/>
Het nummer van het level geeft aan welk gebruikerslevel de gebruiker op het moment heeft.
</h3>
</div>
    <?php
    $user= Admin::downloadEditUserLV();
    foreach($user as $x){
        echo '
        <div class="userblokje">
        <div class="usrinhoud">
            <br>   
            <label>
                <h3>Username</h3>
               '.htmlentities( $x["username"]).'
            </label><br>
            <label>
            <h3>Voornaam</h3>
                 '.htmlentities( $x["voornaam"]).'
            </label><br>
            <label>
            <h3>Achternaam</h3> 
                '.htmlentities( $x["achternaam"]). '
            </label><br>
            <label>
            <h3>E-mail</h3>
                ' .htmlentities( $x["email"]). '
            </label><br>
            <label>
            <h3>Gebruikers nummer:</h3>'.htmlentities($x["uid"]).'
            </label>     
        <form method="post">
        <input type="hidden" value='.$x['uid'].' name="useridea">
            <label>
            <h3>User level</h3>
                    '.htmlentities( $x['user_lv']).'
                    <select class="usrlvs" name="usrlvs">
                        <option value="0">standaard - 0 </option>
                        <option value="1">Gast      - 1 </option>
                        <option value="2">Student   - 2 </option>
                        <option value="3">Leraar    - 3 </option>
                        <option value="4">Beheerder - 4 </option>
                        <option value="5">Administrator - 5 </option>
                    </select>
                </label>
                <br/>
                <br/>
        <input class="submit" type="submit" name="edit-userlevel" value="Wijzig">
    </form>
    </div>
    </div>
        ';      
    };
    ?>
     </div> 
</body>

</html>
