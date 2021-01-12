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
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachten");
        $st->execute();

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

            echo "<label>".$tables[$i]['Field']."</label>"."<br>"."<input class='titel' value='$backLog' type='$type' name='".$tables[$i]['Field']."'><p style='color: red'>$error</p><br>";
            $i ++;
        }

        echo '<div class="txthome-sub"><p>2 Contact/bedrijf gegevens</p></div>';

        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevens");
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

            if (isset($_POST['sendExcersise'])) {
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
            } elseif (!preg_match('/^[a-zA-Z0-9^"\'\/. -]*$/', $waarde)) {
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
        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachten");
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

        $st = $pdo->prepare("INSERT INTO projectenopdrachten($table) VALUES ($waarde)");
        $st->execute();


//        try {
//
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//            $sql = "INSERT INTO projectenopdrachten(Opdracht, AantalStudenten, AantalDeelnemers, Opmerkingen, UitvoeringsDagEnDatum, Straat, Huisnummer, Postcode, Plaats, Budget, TakenVoorStudenten, Tijd, FormStatus) VALUES (:Opdracht, :AantalStudenten, :AantalDeelnemers, :Opmerkingen, :UitvoeringsDagEnDatum, :Straat, :Huisnummer, :Postcode, :Plaats, :Budget, :TakenVoorStudenten, :Tijd, :FormStatus)";
//            $stmt = $conn->prepare($sql);
//            $stmt->bindParam(':Opdracht', $Opdracht);
//            $stmt->bindParam(':AantalStudenten', $AantalStudenten);
//            $stmt->bindParam(':AantalDeelnemers', $AantalDeelnemers);
//            $stmt->bindParam(':Opmerkingen', $Opmerkingen);
//            $stmt->bindParam(':UitvoeringsDagEnDatum', $UitvoeringsDagEnDatum);
//            $stmt->bindParam(':Straat', $Straat);
//            $stmt->bindParam(':Huisnummer', $Huisnummer);
//            $stmt->bindParam(':Postcode', $Postcode);
//            $stmt->bindParam(':Plaats', $Plaats);
//            $stmt->bindParam(':Budget', $Budget);
//            $stmt->bindParam(':TakenVoorStudenten', $TakenVoorStudenten);
//            $stmt->bindParam(':Tijd', $Tijd);
//            $stmt->bindParam(':FormStatus', $FormStatus);
//
//            if(isset($_POST['sendExcersise'])){
//                $opdracht = $_POST['Opdracht'];
//                $aantalStudenten = $_POST['AantalStudenten'];
//                $aantalDeelnemers = $_POST['AantalDeelnemers'];
//                $opmerkingen = $_POST['Opmerkingen'];
//                $uitvoeringsDagEnDatum = $_POST['UitvoeringsDagEnDatum'];
//                $straat = $_POST['Straat'];
//                $huisnummer = $_POST['Huisnummer'];
//                $postcode = $_POST['Postcode'];
//                $plaats = $_POST['Plaats'];
//                $budget = $_POST['Budget'];
//                $takenVoorStudenten = $_POST['TakenVoorStudenten'];
//                $tijd = $_POST['Tijd'];
//                $formStatus = $_POST['FormStatus'];
//            }
//
//            if(isset($_POST['sendExcersise'])){
//                $Opdracht = $opdracht;
//                $AantalStudenten = $aantalStudenten;
//                $AantalDeelnemers = $aantalDeelnemers;
//                $Opmerkingen = $opmerkingen;
//                $UitvoeringsDagEnDatum = $uitvoeringsDagEnDatum;
//                $Straat = $straat;
//                $Huisnummer = $huisnummer;
//                $Postcode = $postcode;
//                $Plaats = $plaats;
//                $Budget = $budget;
//                $TakenVoorStudenten = $takenVoorStudenten;
//                $Tijd = $tijd;
//                $FormStatus = $formStatus;
//                if($opdracht == ''){
//                    echo 'Je moet de opdracht nog invullen.' ;
//                } else if ($aantalStudenten == ''){
//                    echo 'Je moet het aantal studenten nog invullen.';
//                } else if ($aantalDeelnemers == ''){
//                    echo 'Je moet het aantal deelnemers nog invullen.';
//                } else if($uitvoeringsDagEnDatum == ''){
//                    echo 'Je moet uitvoerings dag en datum nog invullen.';
//                } else if($straat == ''){
//                    echo 'Je moet de straat nog invullen.';
//                } else if($huisnummer == ''){
//                    echo 'Je moet het huisnummer nog invullen.';
//                } else if($postcode == ''){
//                    echo 'Je moet de postcode nog invullen.';
//                } else if($plaats == ''){
//                    echo 'Je moet de plaats nog invullen.';
//                } else if($budget == ''){
//                    echo 'Je moet het budget nog invullen.';
//                } else if($takenVoorStudenten == ''){
//                    echo 'Je moet de taken voor de studenten nog invullen.';
//                } else if($tijd == ''){
//                    echo 'Je moet de tijd nog invullen.';
//                } else if($formStatus == ''){
//                    echo 'Je moet nog een status selecteren.';
//                } else {
//                    $stmt->execute();
//                }
//            }
//
//            $sql = "INSERT INTO contactbedrijfgegevens(Email, NaamOrganisatie, NaamContactpersoon, VasteTelefoon, Mobiel, Straat, Huisnummer, Toevoeging, Plaats, Postcode) VALUES (:Email, :NaamOrganisatie, :NaamContactpersoon, :VasteTelefoon, :Mobiel, :Straat, :Huisnummer, :Toevoeging, :Plaats, :Postcode)";
//            $stmt = $conn->prepare($sql);
//            $stmt->bindParam(':Email', $Email);
//            $stmt->bindParam(':NaamOrganisatie', $NaamOrganisatie);
//            $stmt->bindParam(':NaamContactpersoon', $NaamContactpersoon);
//            $stmt->bindParam(':VasteTelefoon', $VasteTelefoon);
//            $stmt->bindParam(':Mobiel', $Mobiel);
//            $stmt->bindParam(':Straat', $Straat);
//            $stmt->bindParam(':Huisnummer', $Huisnummer);
//            $stmt->bindParam(':Toevoeging', $Toevoeging);
//            $stmt->bindParam(':Plaats', $Plaats);
//            $stmt->bindParam(':Postcode', $Postcode);
//
//            if(isset($_POST['sendExcersise'])){
//                $email = $_POST['Email'];
//                $herhaalEmail = $_POST['HerhaalEmail'];
//                $naamOrganisatie = $_POST['NaamOrganisatie'];
//                $naamContactpersoon = $_POST['NaamContactpersoon'];
//                $vasteTelefoon = $_POST['VasteTelefoon'];
//                $mobiel = $_POST['Mobiel'];
//                $straat = $_POST['Straat'];
//                $huisnummer = $_POST['Huisnummer'];
//                $toevoeging = $_POST['Toevoeging'];
//                $plaats = $_POST['Plaats'];
//                $postcode = $_POST['Postcode'];
//            }
//
//            if(isset($_POST['sendExcersise'])){
//                $Email = $email;
//                $HerhaalEmail = $herhaalEmail;
//                $NaamOrganisatie = $naamOrganisatie;
//                $NaamContactpersoon = $naamContactpersoon;
//                $VasteTelefoon = $vasteTelefoon;
//                $Mobiel = $mobiel;
//                $Straat = $straat;
//                $Huisnummer = $huisnummer;
//                $Toevoeging = $toevoeging;
//                $Plaats = $plaats;
//                $Postcode = $postcode;
//                if($email == ''){
//                    echo 'Je moet de email nog invullen.' ;
//                } else if ($herhaalEmail != $email){
//                    echo 'De emails komen niet overeen.';
//                } else if ($naamOrganisatie == ''){
//                    echo 'Je moet de naam van de organisatie nog invullen.';
//                } else if($naamContactpersoon == ''){
//                    echo 'Je moet de opmerking nog invullen.';
//                } else if($vasteTelefoon == ''){
//                    echo 'Je moet de vaste telefoon nog invullen.';
//                } else if($mobiel == ''){
//                    echo 'Je moet de mobiele telefoon nog invullen.';
//                } else if($straat == ''){
//                    echo 'Je moet de straat nog invullen.';
//                }  else if($huisnummer == ''){
//                    echo 'Je moet het huisnummer nog invullen.';
//                }  else if($toevoeging == ''){
//                    echo 'Je moet de toevoeging nog invullen.';
//                } else if($plaats == ''){
//                    echo 'Je moet de plaats nog invullen.';
//                } else if($postcode == ''){
//                    echo 'Je moet de postcode nog invullen.';
//                } else {
//                    $stmt->execute();
//                }
//            }
//        } catch(PDOException $e) {
//            echo "Error: " . $e->getMessage();
//        }
//        $conn = null;

        // get columns from 'contactbedrijfgegevens'
        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevens");
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

        $st = $pdo->prepare("INSERT INTO contactbedrijfgegevens ($table) VALUES ($waarde)");
        $st->execute();

    }
}