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

    public static function uploadElementOp($titel, $inputType, $type) {
        $pdo = self::connect();

        switch ($inputType) {
            case "date":
                $st = $pdo->prepare("ALTER TABLE $type ADD $titel date");
                break;
            case "time":
                $st = $pdo->prepare("ALTER TABLE $type ADD $titel time");
                break;
            case "txt":
                $st = $pdo->prepare("ALTER TABLE $type ADD $titel varchar(255)");
                break;
            case "valuta":
            case "int":
                $st = $pdo->prepare("ALTER TABLE $type ADD $titel int(255)");
                break;
        }

        $st->execute();

        header('Location: /formulier');
    }

    public static function getElementsForm() {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachten");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
        while ($count > $i) {
            echo "<div class='add-form-3'>".$tables[$i]['Field']."<button type='button' class='deleteRow'>-</button></div>"."<br>";
            $i ++;
        }
    }

    public static function getElementsFormCont() {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevens");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
        while ($count > $i) {
            echo "<div class='add-form-3'>".$tables[$i]['Field']."<button type='button' class='deleteRowC'>-</button></div>"."<br>";
            $i ++;
        }
    }

    public static function deleteElementOp($column) {
        $pdo = self::connect();
        $st = $pdo->prepare("ALTER TABLE projectenopdrachten DROP COLUMN $column");
        $st->execute();
    }

    public static function deleteElementCo($column) {
        $pdo = self::connect();
        $st = $pdo->prepare("ALTER TABLE contactbedrijfgegevens DROP COLUMN $column");
        $st->execute();
    }

    public static function deleteElementExc($id) {
        $pdo = self::connect();
        $st = $pdo->prepare("DELETE FROM projectenopdrachten WHERE project_id = $id");
        $st->execute();
    }
}

public static function downloadEditUserLV(){    
    $pdo = self::connect();
    $st =  $pdo->prepare("SELECT * FROM users");
    $st->execute();
    
    $user=  $st->fetchAll(PDO::FETCH_ASSOC);
    

return $user;
}

public static function editUserLV($uid, $user_lv){
    $pdo = self::connect();
    $st = $pdo->prepare("UPDATE users SET user_lv=:userlv WHERE uid=:id");
    $st->bindParam(":id", $uid, PDO::PARAM_STR);
    $st->bindParam(":userlv", $user_lv, PDO::PARAM_STR);
    $st->execute();
    header("Location: /adminpanel");
    }

}