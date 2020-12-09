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
        echo "<script> location.href='/index.php'; </script>";
    }
}

if(isset($_POST["signupSubmit"])) {
  $username = $_POST["usernameReg"];
  $password = $_POST["passwordReg"];
  $email = $_POST["emailReg"];
  $name = $_POST["nameReg"];

  //$username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $username);
  //$email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
  //$password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $password);

  Login::userRegistration($username, $password, $email, $name);
}
