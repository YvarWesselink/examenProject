<?php
require_once "routes.php";

// hier hoeft verder geen code bij!
function __autoload($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
    } else if (file_exists('./controller/'.$class_name.'.php')) {
        require_once './controller/'.$class_name.'.php';
    }
}

if(isset($_POST["loginSubmit"])) {
  $username = $_POST["usernameEmail"];
  $password = $_POST["password"];

  $uid = Login::userLogin($username , $password);

  if ($uid) {
        echo "<script> location.href='/adminpanel'; </script>";
    }
}

if(isset($_POST["signupSubmit"])) {
  $username = $_POST["usernameReg"];
  $password = $_POST["passwordReg"];
  $email = $_POST["emailReg"];
  $name = $_POST["nameReg"];

  $uid = Login::userRegistration($username, $password, $email, $name);

  if ($uid) {
    echo "<script> location.href='/login'; </script>";
  }

  //$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
  //$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
  //$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

  Login::userRegistration($username, $password, $email, $name);
}

if (isset($_POST['upload'])) {
    $titel = $_POST['titel'];
    $tussenkop = $_POST['tussenkop'];
    $txthome = $_POST['hometxt'];

    Admin::uploadHomeTXT($titel, $tussenkop, $txthome);
}

if (isset($_POST['edit-user'])) {
    $username = $_POST['username'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $straat = $_POST['straat'];
    $plaats = $_POST['plaats'];
    $postcode = $_POST['postcode'];
    $mobiel = $_POST['mobiel'];
    $website = $_POST['website'];

    $id = $_SESSION['uid'];

    Admin::editUser($username, $voornaam, $achternaam, $email, $straat, $plaats, $postcode, $mobiel, $website, $id);
}

if (isset($_POST['update'])) {
    // opdracht forumulier aanpassen
    $titel = $_POST['titel'];
    $inputType = $_POST['input-type'];
    $type = $_POST['type'];

    Admin::uploadElementOp($titel, $inputType, $type);
}

if (isset($_POST['edit-userlevel'])) {
    $uid=$_POST['useridea'];
    $user_lv= $_POST['usrlvs'];
    

    Admin::editUserLV($uid, $user_lv);
}

if (isset($_POST['but_upload'])){
    $album = $_POST['album'];
    Admin::uploadImage($album);
}

if (isset($_POST['albums'])) {
    $naam = $_POST['naam'];
    $school = $_POST['school'];
    Admin::uploadAlbum($naam, $school);
}

if (isset($_POST['delete-album'])) {
    $naam = $_POST['album'];
    Admin::deleteAlbum($naam);
}

if (isset($_POST['delete-image'])) {
    $id = $_POST['album'];
    Admin::deleteImage($id);
}

if (isset($_POST['homepage'])) {
    $id = $_POST['album'];
    $naam = $_POST['naam'];
    Admin::homepageImage($id, $naam);
}

if (isset($_POST['news'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $company = $_POST['Company'];
    $comments = $_POST['Comments'];
    $school = $_POST['school'];
    nieuws::UploadNews($name, $email, $company, $comments, $school);
}

if (isset($_POST['upload_contact'])) {
    $straat = $_POST['straat'];
    $penp = $_POST['penp'];
    $email = $_POST['email'];
    $telnmr = $_POST['telnmr'];

    Admin::uploadcontactTXT($straat, $penp, $email, $telnmr);
}

if (isset($_POST['uploadzwolle'])) {
    $titelz = $_POST['titelz'];
    $tussenz = $_POST['tussenz'];
    $zwolletxt = $_POST['zwolletxt'];

    Admin::uploadzwolleTXT($titelz, $tussenz, $zwolletxt);
}

if (isset($_POST['uploadsalland'])) {
    $titels = $_POST['titels'];
    $tussens = $_POST['tussens'];
    $sallandtxt = $_POST['sallandtxt'];

    Admin::uploadsallandTXT($titels, $tussens, $sallandtxt);
}