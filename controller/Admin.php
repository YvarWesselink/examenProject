<?php


class Admin extends controller
{

    public static function uploadHomeTXT($titel, $tussenkop, $txthome)
    {
        $pdo = self::connect();

        $st = $pdo->prepare("UPDATE texthome SET titel=:titel, tussenkopje=:tussenkopje, home=:txthome WHERE id = 1");

        $st->bindParam(":titel", $titel,PDO::PARAM_STR);
        $st->bindParam(":tussenkopje", $tussenkop,PDO::PARAM_STR);
        $st->bindParam(":txthome", $txthome,PDO::PARAM_STR);
        $st->execute();

        header("Location: /txthome");
    }

    public static function downloadTXT() {
        $pdo = self::connect();

        $st = $pdo->prepare("SELECT * FROM texthome WHERE id = 1");
        $st->execute();

        $home = $st->fetch(PDO::FETCH_ASSOC);

        return $home;
    }

    public static function editUser($username, $voornaam, $achternaam, $email, $straat, $plaats, $postcode, $mobiel, $website, $id)
    {
        $pdo = self::connect();

        $_SESSION['username']=$username;
        $st = $pdo->prepare("update users set username=:username, voornaam=:voornaam, achternaam=:achternaam, email=:email, straat=:straat, plaats=:plaats, postcode=:postcode, mobiel=:mobiel, website=:website where uid=:id");

        $st->bindParam(":username", $username, PDO::PARAM_STR);
        $st->bindParam(":voornaam", $voornaam, PDO::PARAM_STR);
        $st->bindParam(":achternaam", $achternaam, PDO::PARAM_STR);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->bindParam(":straat", $straat, PDO::PARAM_STR);
        $st->bindParam(":plaats", $plaats, PDO::PARAM_STR);
        $st->bindParam(":postcode", $postcode, PDO::PARAM_STR);
        $st->bindParam(":mobiel", $mobiel, PDO::PARAM_STR);
        $st->bindParam(":website", $website, PDO::PARAM_STR);

        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();

        header("Location: /acgegevens");
    }

    public static function downloadUser($id) {
        $pdo=self::connect();

        $st = $pdo->prepare("SELECT username, voornaam, achternaam, email, straat, plaats, postcode, mobiel, website FROM users WHERE uid=:id");
        $st->bindParam(":id", $id, PDO::PARAM_STR);
        $st->execute();

        $user = $st->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public static function logout() {
        session_start();
        unset($_SESSION['uid']);
        unset($_SESSION['username']);
        header('Location: /index.php');
    }
}