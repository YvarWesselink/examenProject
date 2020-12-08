<?php
class excersises extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");
    }    
}

global $conn;
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=praktijkplaza", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $sql = "INSERT INTO projectenopdrachten(Opdracht, AantalStudenten, Opmerkingen, UitvoeringsDagEnDatum, LocatieAdresEnPlaatsVanUitvoering, Deadline, Budget, TakenVoorStudenten, Tijd) VALUES (:Opdracht, :AantalStudenten, :Opmerkingen, :UitvoeringsDagEnDatum, :LocatieAdresEnPlaatsVanUitvoering, :Deadline, :Budget, :TakenVoorStudenten, :Tijd)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':Opdracht', $Opdracht);
  $stmt->bindParam(':AantalStudenten', $AantalStudenten);
  $stmt->bindParam(':Opmerkingen', $Opmerkingen);
  $stmt->bindParam(':UitvoeringsDagEnDatum', $UitvoeringsDagEnDatum);
  $stmt->bindParam(':LocatieAdresEnPlaatsVanUitvoering', $LocatieAdresEnPlaatsVanUitvoering);
  $stmt->bindParam(':Deadline', $Deadline);
  $stmt->bindParam(':Budget', $Budget);
  $stmt->bindParam(':TakenVoorStudenten', $TakenVoorStudenten);
  $stmt->bindParam(':Tijd', $Tijd);

  if(isset($_POST['sendExcersise'])){
    $opdracht = $_POST['Opdracht'];
    $aantalStudenten = $_POST['AantalStudenten'];
    $opmerkingen = $_POST['Opmerkingen'];
    $uitvoeringsDagEnDatum = $_POST['UitvoeringsDagEnDatum'];
    $locatieAdresEnPlaatsVanUitvoering = $_POST['LocatieAdresEnPlaatsVanUitvoering'];
    $deadline = $_POST['Deadline'];
    $budget = $_POST['Budget'];
    $takenVoorStudenten = $_POST['TakenVoorStudenten'];
    $tijd = $_POST['Tijd'];
  }

  if(isset($_POST['sendExcersise'])){
    $Opdracht = $opdracht;
    $AantalStudenten = $aantalStudenten;
    $Opmerkingen = $opmerkingen;
    $UitvoeringsDagEnDatum = $uitvoeringsDagEnDatum;
    $LocatieAdresEnPlaatsVanUitvoering = $locatieAdresEnPlaatsVanUitvoering;
    $Deadline = $deadline;
    $Budget = $budget;
    $TakenVoorStudenten = $takenVoorStudenten;
    $Tijd = $tijd;
    $stmt->execute();
  }  
  
  $sql2 = "INSERT INTO contactbedrijfgegevens(Email, NaamOrganisatie, NaamContactpersoon, VasteTelefoon, Mobiel, StraatEnHuisnummer, Woonplaats, Postcode) VALUES (:Email, :NaamOrganisatie, :NaamContactpersoon, :VasteTelefoon, :Mobiel, :StraatEnHuisnummer, :Woonplaats, :Postcode)";
  $stmt = $conn->prepare($sql2);
  $stmt->bindParam(':Email', $Email);
  $stmt->bindParam(':NaamOrganisatie', $NaamOrganisatie);
  $stmt->bindParam(':NaamContactpersoon', $NaamContactpersoon);
  $stmt->bindParam(':VasteTelefoon', $VasteTelefoon);
  $stmt->bindParam(':Mobiel', $Mobiel);
  $stmt->bindParam(':StraatEnHuisnummer', $StraatEnHuisnummer);
  $stmt->bindParam(':Woonplaats', $Woonplaats);
  $stmt->bindParam(':Postcode', $Postcode);

  if(isset($_POST['sendExcersise'])){
    $email = $_POST['Email'];
    $naamOrganisatie = $_POST['NaamOrganisatie'];
    $naamContactpersoon = $_POST['NaamContactpersoon'];
    $vasteTelefoon = $_POST['VasteTelefoon'];
    $mobiel = $_POST['Mobiel'];
    $straatEnHuisnummer = $_POST['StraatEnHuisnummer'];
    $woonplaats = $_POST['Woonplaats'];
    $postcode = $_POST['Postcode'];
  }

  if(isset($_POST['sendExcersise'])){
    $Email = $email;
    $NaamOrganisatie = $naamOrganisatie;
    $NaamContactpersoon = $naamContactpersoon;
    $VasteTelefoon = $vasteTelefoon;
    $Mobiel = $mobiel;
    $StraatEnHuisnummer = $straatEnHuisnummer;
    $Woonplaats = $woonplaats;
    $Postcode = $postcode;
    $stmt->execute();
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;