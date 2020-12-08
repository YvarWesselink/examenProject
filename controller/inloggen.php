<?php

class inloggen extends controller {
    // Schrijf hier je functies
    }

session_start();
/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'examenopdracht');
define("BASE_URL", "http://localhost/PHPLoginHash/"); // Eg. http://yourwebsite.com


function getDB()
{
$dbhost='127.0.0.1';
$dbuser='root';
$dbpass='';
$dbname='examenopdracht';
try {
$dbConnection = new PDO("mysql:host=$dbhost;examenopdracht=$dbname", $dbuser, $dbpass);
$dbConnection->exec("set names utf8");9
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $dbConnection;
}
catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}

}
?>