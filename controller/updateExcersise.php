<?php
class updateExcersise extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }

<<<<<<< Updated upstream
        $conn = self::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM projectenopdrachtens");
        if ($result->rowCount() > 0){
          $row = $result->fetchAll(PDO::FETCH_ASSOC);
          $count = count($row);
          $ind = 0;
          while($count > $ind){
            $Opdracht = $row[$ind]['Opdracht'];
            $Opmerkingen = $row[$ind]['Opmerkingen'];
            $AantalStudenten = $row[$ind]['AantalStudenten'];
            $UitvoeringsDagEnDatum = $row[$ind]['UitvoeringsDagEnDatum'];
            $ind ++;
          }
          $oudeWaardes = array();
          array_push($oudeWaardes, $Opdracht, $AantalStudenten, $Opmerkingen, $UitvoeringsDagEnDatum);
        }
=======
    public static function showFields($errormsg) {
        // $conn = self::connect();
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $result = $conn->query("SELECT * FROM projectenopdrachtens");
        // if ($result->rowCount() > 0){
        //   $row = $result->fetchAll(PDO::FETCH_ASSOC);
        //   $count = count($row);
        //   $ind = 0;
        //   while($count > $ind){
        //     $Opdracht = $row[$ind]['Opdracht'];
        //     $Opmerkingen = $row[$ind]['Opmerkingen'];
        //     $AantalStudenten = $row[$ind]['AantalStudenten'];
        //     $UitvoeringsDagEnDatum = $row[$ind]['UitvoeringsDagEnDatum'];
        //     $ind ++;
        //   }
        //   $oudeWaardes = array();
        //   array_push($oudeWaardes, $Opdracht, $AantalStudenten, $Opmerkingen, $UitvoeringsDagEnDatum);
        // }
>>>>>>> Stashed changes
        $pdo = self::connect();
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtens");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);
        $i = 1;

        $id = $_SESSION['project_id'];
        $stmt = $pdo->prepare("SELECT * FROM projectenopdrachtens WHERE project_id = $id");
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

        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevenss");
        $st->execute();

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

            if (isset($_POST['uploadExcersise'])) {
                $value = $_POST;
                $key = $tabless[$x]['Field'];

                $backLog = $value[$key];
            } else {
                $backLog = "";
            }

            echo "<label>".$tabless[$x]['Field']."</label>"."<br>"."<input class='titel' value='$backLog' type='$typee' name='".$tabless[$x]['Field']."'><p style='color: red'>$error</p><br>";
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
            } elseif (!preg_match('/^[a-zA-Z0-9^@"\'\/. -]*$/', $waarde)) {
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
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachtens");
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
            array_push($waardeAr, "'".$waarden[$wIndex]."'");

            $rij++;
            $war++;
        }

        $table = implode(", ", $tableAr);
        $waarde = implode(", ", $waardeAr);
        print_r($waarde);
        $id = $_SESSION['project_id'];
        $st = $pdo->prepare("UPDATE projectenopdrachtens ($table) SET ($waarde) WHERE project_id=$id");
        $st->execute();

        // get columns from 'contactbedrijfgegevens'
        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevenss");
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
            array_push($waardeCoAr, "'".$waarden[$oIndex]."'");

            $count ++;
            $rijCO ++;
        }

        $table = implode(", ", $tableCoAr);
        $waarde = implode(", ", $waardeCoAr);

        $st = $pdo->prepare("INSERT INTO contactbedrijfgegevenss ($table) VALUES ($waarde)");
        $st->execute();

        header("Location: /opdrachten");
    }
}