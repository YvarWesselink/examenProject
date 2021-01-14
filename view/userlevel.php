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
<div class="txthome-container">
    <?php
    $user= Admin::downloadEditUserLV();
    
    foreach($user as $x){
        //print_r($x);
        echo '
        <div class="userblokje">
            <label>
            Gebruikers nummer:'.htmlentities($x["uid"]).'
            </label>     
            <br>   
            <label>
                Username<br>
               '.htmlentities( $x["username"]).'
            </label><br>
            <label>
                Voornaam<br>
                 '.htmlentities( $x["voornaam"]).'
            </label><br>
            <label>
                Achternaam <br>
                '.htmlentities( $x["achternaam"]). '
            </label><br>
            <label>
                 E-mail <br>
                ' .htmlentities( $x["email"]). '
            </label><br>
        </div>
        <br/>
        <br/>
        <form method="post">
        <input type="hidden" value='.$x['uid'].' name="useridea">
            <label>
                    User level <br>
                    '.htmlentities( $x['user_lv']).'
                    <select class="usrlvs" name="usrlvs">
                        <option value="0">standaard</option>
                        <option value="1">Gast</option>
                        <option value="2">Student</option>
                        <option value="3">Leeraar</option>
                        <option value="4">Beheerder</option>
                    </select>
                </label>
        <input class="submit" type="submit" name="edit-userlevel" value="Wijzig">
    </form>
    </div>
        ';      
    };
    ?>
</body>

</html>
