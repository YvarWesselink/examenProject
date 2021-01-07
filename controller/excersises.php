<?php
class excersises extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }

    public static function showFields() {
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

            echo "<label>".$tables[$i]['Field']."</label>"."<br>"."<input class='titel' type='$type' name='".$tables[$i]['Field']."'><br>";
            $i ++;
        }

        echo '<div class="txthome-sub"><p>2 Contact/bedrijf gegevens</p></div>';

        $st = $pdo->prepare("SHOW COLUMNS FROM contactbedrijfgegevens");
        $st->execute();

        $tabless = $st->fetchAll(PDO::FETCH_ASSOC);
        $countt = count($tabless);

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

            echo "<label>".$tabless[$x]['Field']."</label>"."<br>"."<input class='titel' type='$typee' name='".$tabless[$x]['Field']."'><br>";
            $x ++;
        }
    }

    public static function UploadExersise($waarden) {
        $pdo = self::connect();

        $st = $pdo->prepare("SHOW COLUMNS FROM projectenopdrachten");
        $st->execute();

        $tables = $st->fetchAll(PDO::FETCH_ASSOC);
        $count = count($tables);

        $rij = 1;
        $war = 0;

//        print_r($tables[1]['Field']);
//        exit();

        while ($count > $rij) {
            $table = $tables[$rij]['Field'];
            $waarde = $waarden[$table];

            echo $table;

//            $st = $pdo->prepare("INSERT INTO projectenopdrachten($table) VALUES ($waarde)");
//            $st->execute();

            $rij++;
            $war++;
        }

        exit();
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
    }
}