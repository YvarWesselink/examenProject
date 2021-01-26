<?php
class excersises extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }

    public static function showFields($errormsg) {
        $pdo = self::connect();
        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtenz");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtens");
            $st->execute();
        }

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $i = 1;
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

            if (isset($_POST['sendExcersise'])) {
                $value = $_POST;
                $key = $tables[$i]['Field'];

                $backLog = $value[$key];
            } else {
                $backLog = "";
            }

            $table = str_replace('_', ' ',$tables[$i]['Field']);

            echo "<label>".$table."</label>"."<br>"."<input class='titel' value='$backLog' type='$type' name='".$tables[$i]['Field']."'><p style='color: red'>$error</p><br>";
            $i ++;
        }

        echo '<div class="txthome-sub"><p>2 Contact/bedrijf gegevens</p></div>';

        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevensz");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevenss");
            $st->execute();
        }

        $tabless = $st->fetchAll(PDO::FETCH_ASSOC);
        $countt = count($tabless);

        $e = 0;
        $x = 1;
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

            if (isset($_POST['sendExcersise'])) {
                $value = $_POST;
                $key = $tabless[$x]['Field'];

                $backLog = $value[$key];
            } else {
                $backLog = "";
            }

            $table = str_replace('_', ' ',$tabless[$x]['Field']);

            echo "<label>".$table."</label>"."<br>"."<input class='titel' value='$backLog' type='$typee' name='".$tabless[$x]['Field']."'><p style='color: red'>$error</p><br>";
            $x ++;
            $e ++;
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
        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtenz");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtens");
            $st->execute();
        }

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $rij = 1;
        $war = 0;

        // define arrays
        $tableAr = array();
        $waardeAr = array();

        if ($_SESSION['school'] == "zwolle") {
            // Get id from projectenopdracht
            $st = $pdo->prepare("SELECT * FROM projectenopdrachtenz");
            $st->execute();
            $countId = $st->fetchAll(PDO::FETCH_ASSOC);

            $id = count($countId);
            $id += 1;

            array_push($tableAr, "id");
            array_push($waardeAr, $id);
        } elseif ($_SESSION['school'] == "salland") {
            // Get id from projectenopdracht
            $st = $pdo->prepare("SELECT * FROM projectenopdrachtens");
            $st->execute();
            $countId = $st->fetchAll(PDO::FETCH_ASSOC);

            $id = count($countId);
            $id += 1;

            array_push($tableAr, "id");
            array_push($waardeAr, $id);
        }

        // push data from 'projectenopdrachten' to array.
        while ($count > $rij) {
            // push column values of database to array
            array_push($tableAr, $tables[$rij]['Field']);

            // push row values of database to array
            $wIndex = $tables[$rij]['Field'];
            array_push($waardeAr, "'".$waarden[$wIndex]."'");

            $rij++;
            $war++;
        }

        $table = implode(", ", $tableAr);
        $waarde = implode(", ", $waardeAr);

        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("INSERT INTO projectenopdrachtenz($table) VALUES ($waarde)");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("INSERT INTO projectenopdrachtens($table) VALUES ($waarde)");
            $st->execute();
        }


        // get columns from 'contactbedrijfgegevens'
        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevensz");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevenss");
            $st->execute();
        }

        $tablesCO = $st->fetchAll(PDO::FETCH_ASSOC);
        $countCO = count($tablesCO);

        // inex of the contactbedrijfgegevens (minus 1 (id))
        $rijCO = 1;

        //define arrays
        $tableCoAr = array();
        $waardeCoAr = array();

        if ($_SESSION['school'] == "zwolle") {
            // Get id from projectenopdracht
            array_push($tableCoAr, "id");
            array_push($waardeCoAr, $id);
        } elseif ($_SESSION['school'] == "salland") {
            // Get id from projectenopdracht
            array_push($tableCoAr, "id");
            array_push($waardeCoAr, $id);
        }

        while ($countCO > $rijCO) {
            array_push($tableCoAr, $tablesCO[$rijCO]['Field']);

            $oIndex = $tablesCO[$rijCO]['Field'];
            array_push($waardeCoAr, "'".$waarden[$oIndex]."'");

            $count ++;
            $rijCO ++;
        }

        $table = implode(", ", $tableCoAr);
        $waarde = implode(", ", $waardeCoAr);

        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("INSERT INTO contactbedrijfgegevensz ($table) VALUES ($waarde)");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("INSERT INTO contactbedrijfgegevenss ($table) VALUES ($waarde)");
            $st->execute();
        }

        // verborgen waarden uploaden (leeg)
        if ($_SESSION['school'] == "zwolle") {
            $st = $pdo->prepare("INSERT INTO verborgenwaardenz (id) VALUES ($id)");
            $st->execute();
        } elseif ($_SESSION['school'] == "salland") {
            $st = $pdo->prepare("INSERT INTO verborgenwaardens (id) VALUES ($id)");
            $st->execute();
        }

        header("Location: /opdrachten");
    }
}