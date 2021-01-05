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
    $titel = $_POST['titel'];
    $inputType = $_POST['input-type'];

    Admin::uploadElementOp($titel, $inputType);
}
