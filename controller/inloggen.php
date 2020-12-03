<?php

class inloggen extends controller {
    // Schrijf hier je functies
    }

$username ="";
$email ="";
$errors = array();


//connectie met database

$db = mysqli_connect('localhost', 'root', '', 'examenopdracht');

// if the register button is clicked

if(isset($_POST['register'])) {
    $username = ($_POST['username']);
    $email = ($_POST['email']);
    $password_1 = ($_POST['password_1']);
    $password_2 = ($_POST['password_2']);
    
    
    // ensure that form fields are filled properly
    
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    
    
    // if there are no errors, save user to db
    
    if (count($errors) == 0) {
        $password = md5($password_1); // encrypt password before storing in db (security)
        $sql = "INSERT INTO users (username, email, password) 
                    VALUES ('$username', '$email', '$password')";
        mysqli_query($db, $sql);
    }
    
}

?>