<?php
class updateExcersiseZ extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }

    public static function showFields($errormsg) {
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtenz");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);
        $i = 1;

        $id = $_SESSION['id'];
        $stmt = $pdo->prepare("SELECT * FROM projectenopdrachtenz WHERE id = $id");
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
            echo "<label>".$tables[$i]['Field']."</label>"."<br>"."<input class='titel' value='$variables[$i]' type='$type' name='".$tables[$i]['Field']."'><p style='color: red'>$error</p><br>";
            $i ++;
            $index ++;
            $ind++;
        }

        echo '<div class="txthome-sub"><p>2 Contact/bedrijf gegevens</p></div>';

        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevensz");
        $st->execute();

        $tabless = $st->fetchAll(PDO::FETCH_ASSOC);
        $countt = count($tabless);

        $e = 0;
        $x = 1;
        $stm = $pdo->prepare("SELECT * FROM contactbedrijfgegevensz WHERE id = $id");
        $stm->execute();
        $contactValues = $stm->fetchAll(PDO::FETCH_ASSOC);
        $variableContactCount = count($contactValues);
        $ind = 0;
        while ($countt > $x) {
            switch ($tabless[$x]['Type']) {
                case "varchar(255)":
                    $typee = "text";
                    break;
                case "date":
                    $typee = "date";
                    break;
                case "time":
                    $typee = "time";
                    break;
                case "int(255)":
                    $typee = "number";
                    break;
            }

            if (empty($errormsg)) {
                $error = "";
            } else {
                $error = $errormsg[$tabless[$x]['Field']];
            }

            if (isset($_POST['uploadExcersise'])) {
                $value = $_POST;
                $key = $tabless[$x]['Field'];

                $backLog = $value[$key];
            } else {
                while($variableContactCount > $ind){
                    $value = $contactValues;
                    $variables = array_values($value[$ind]);
                    $ind ++;
                }
            }

            echo "<label>".$tabless[$x]['Field']."</label>"."<br>"."<input class='titel' value='$variables[$x]' type='$typee' name='".$tabless[$x]['Field']."'><p style='color: red'>$error</p><br>";
            $x ++;
            $e ++;
            $ind ++;
        }

        echo '<div class="txthome-sub"><p>3 Verborgen waardes</p></div>';

        $st = $pdo->prepare("SHOW COLUMNS FROM verborgenwaardenz");
        $st->execute();

        $tabless = $st->fetchAll(PDO::FETCH_ASSOC);
        $countt = count($tabless);

        $e = 0;
        $x = 1;
        $stm = $pdo->prepare("SELECT * FROM verborgenwaardenz WHERE id = $id");
        $stm->execute();
        $contactValues = $stm->fetchAll(PDO::FETCH_ASSOC);
        $variableContactCount = count($contactValues);
        $ind = 0;
        while ($countt > $x) {
            switch ($tabless[$x]['Type']) {
                case "varchar(255)":
                    $typee = "text";
                    break;
                case "date":
                    $typee = "date";
                    break;
                case "time":
                    $typee = "time";
                    break;
                case "int(255)":
                    $typee = "number";
                    break;
            }

            if (empty($errormsg)) {
                $error = "";
            } else {
                $error = $errormsg[$tabless[$x]['Field']];
            }

            if (isset($_POST['uploadExcersise'])) {
                $value = $_POST;
                $key = $tabless[$x]['Field'];

                $backLog = $value[$key];
            } else {
                while($variableContactCount > $ind){
                    $value = $contactValues;
                    $variables = array_values($value[$ind]);
                    $ind ++;
                }
            }

            echo "<label>".$tabless[$x]['Field']."</label>"."<br>"."<input class='titel' value='$variables[$x]' type='$typee' name='".$tabless[$x]['Field']."'><p style='color: red'>$error</p><br>";
            $x ++;
            $e ++;
            $ind ++;
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
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtenz");
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
            $st = $pdo->prepare("UPDATE projectenopdrachtenz SET $tableAr[$i]=:waarde WHERE id = $id");
            $st->bindParam(":waarde", $waardeAr[$i], PDO::PARAM_STR);
            $st->execute();
            $i++;
        }
        // get columns from 'contactbedrijfgegevens'
        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevensz");
        $st->execute();

        $tablesCO = $st->fetchAll(PDO::FETCH_ASSOC);
        $countCO = count($tablesCO);

        // inex of the contactbedrijfgegevens (minus 1 (id))
        $rijCO = 1;

        //define arrays
        $tableCoAr = array();
        $waardeCoAr = array();

        while ($countCO > $rijCO) {
            array_push($tableCoAr, $tablesCO[$rijCO]['Field']);

            $oIndex = $tablesCO[$rijCO]['Field'];
            array_push($waardeCoAr, $waarden[$oIndex]);

            $count ++;
            $rijCO ++;
        }
        $i = 0;
        foreach ($waardeCoAr as $waard) {
            echo $waard;
            $st = $pdo->prepare("UPDATE contactbedrijfgegevensz SET $tableCoAr[$i]=:waarde WHERE id = $id");
            $st->bindParam(":waarde", $waardeCoAr[$i], PDO::PARAM_STR);
            $st->execute();
            $i++;
        }        
        
        // get columns from 'verborgenwaardens'
        $st = $pdo->prepare("SHOW COLUMNS FROM verborgenwaardenz");
        $st->execute();

        $tablesVa = $st->fetchAll(PDO::FETCH_ASSOC);
        $countVa = count($tablesVa);

        // inex of the verborgenwaardens (minus 1 (id))
        $rijVa = 1;

        //define arrays
        $tableVaAr = array();
        $waardeVaAr = array();

        while ($countVa > $rijVa) {
            array_push($tableVaAr, $tablesVa[$rijVa]['Field']);

            $vaIndex = $tablesVa[$rijVa]['Field'];
            array_push($waardeVaAr, $waarden[$vaIndex]);

            $count ++;
            $rijVa ++;
        }
        $i = 0;
        foreach ($waardeVaAr as $waard) {
            echo $waard;
            $st = $pdo->prepare("UPDATE verborgenwaardenz  SET $tableVaAr[$i]=:waarde WHERE id = $id");
            $st->bindParam(":waarde", $waardeVaAr[$i], PDO::PARAM_STR);
            $st->execute();
            $i++;
        }

        header("Location: /opdrachten-formulier");
    }
}