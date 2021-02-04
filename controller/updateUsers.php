<?php
class updateUsers extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }

    public static function showFields($errormsg) {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM users");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);
        $i = 1;

        $id = $_SESSION['id'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = $id");
        $stmt->execute();
        $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $variableCount = count($values);
        $index = 0;
        while ($count > $i) {
            switch ($tables[$i]['Type']) {
                case "varchar(255)":
                    $type = "text";
                    break;
                case "date":
                    $type = "date";
                    break;
                case "time":
                    $type = "time";
                    break;
                case "int(255)":
                    $type = "number";
                    break;
            }

            if (empty($errormsg)) {
                $error = "";
            } else {
                $error = $errormsg[$tables[$i]['Field']];
            }
            if (isset($_POST['uploadExcersise'])) {
                $value = $_POST;
                $key = $tables[$i]['Field'];
                $backLog = $value[$key];
            } else {
                while($variableCount > $index){
                    $value = $values;
                    $variables = array_values($value[$index]);
                    $index ++;
                }
            }
            $ind = 0;
            echo "<label>".$tables[$i]['Field']."</label>"."<br>"."<input class='titel' value='$variables[$i]' name='".$tables[$i]['Field']."'><p style='color: red'>$error</p><br>";
            $i ++;
            $index ++;
            $ind++;
        }
    }

    public static function checkExcersise($waarden) {

        $errormsg = array();

        $errorKey = array();
        $errorVal = array();

        foreach ($waarden as $key => $value) {
            array_push($errorKey, $key);
        }

        foreach ($waarden as $waarde) {
            if (empty($waarde)) {
                $error = "Voer een waarde in.";
                array_push($errorVal, $error);
            } elseif (!preg_match('/^[a-zA-Z0-9^@:"\'\/. -]*$/', $waarde)) {
                $error = "Gebruik geen rare karakters.";
                array_push($errorVal, $error);
            } elseif ($waarde) {
                array_push($errorVal, "");
            }
        }

        $i = 0;
        foreach ($waarden as $waarde) {
            $errormsg[$errorKey[$i]] = $errorVal[$i];
            $i++;
        }

        return $errormsg;
    }

    public static function UploadExersise($waarden) {
        $pdo = self::connect();

        // get columns from 'projectenopdrachten'
        $st = $pdo->prepare("SHOW COLUMNS FROM users");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $rij = 1;
        $war = 0;

        // define arrays
        $tableAr = array();
        $waardeAr = array();

        // push data from 'projectenopdrachten' to array.
        while ($count > $rij) {
            // push column values of database to array
            array_push($tableAr, $tables[$rij]['Field']);

            // push row values of database to array
            $wIndex = $tables[$rij]['Field'];
            array_push($waardeAr, $waarden[$wIndex]);

            $rij++;
            $war++;
        }
        $id = $_SESSION['id'];
        $i = 0;
        foreach ($waardeAr as $waard) {
            echo $waard;
            $st = $pdo->prepare("UPDATE users SET $tableAr[$i]=:waarde WHERE uid = $id");
            $st->bindParam(":waarde", $waardeAr[$i], PDO::PARAM_STR);
            $st->execute();
            $i++;
        }

        header("Location: /opdrachten-formulier");
    }
}