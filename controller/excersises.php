<?php
class excersises extends Database {

    // deze functie laad de view van de pagina die in de url staat.
    // $viewName is dus de variabel die uit de url wordt gehaald.
    public static function CreateView($viewName)
    {
        require_once("./view/$viewName.php");

    }

}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'praktijkplaza');

global $conn;
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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
    createExcersise($opdracht, $aantalStudenten, $opmerkingen, $uitvoeringsDagEnDatum, $locatieAdresEnPlaatsVanUitvoering, $deadline, $budget, $takenVoorStudenten, $tijd);
}

function createExcersise($opdracht, $aantalStudenten, $opmerkingen, $uitvoeringsDagEnDatum, $locatieAdresEnPlaatsVanUitvoering, $deadline, $budget, $takenVoorStudenten, $tijd){
    global $conn;
    $sql = "INSERT INTO projectenopdrachten (Opdracht, AantalStudenten, Opmerkingen, UitvoeringsDagEnDatum, LocatieAdresEnPlaatsVanUitvoering, Deadline, Budget, TakenVoorStudenten, Tijd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssss', $opdracht, $aantalStudenten, $opmerkingen, $uitvoeringsDagEnDatum, $locatieAdresEnPlaatsVanUitvoering, $deadline, $budget, $takenVoorStudenten, $tijd);
    if ( false === $stmt ) {
        die('prepare() failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->bind_param('sssssssss', $opdracht, $aantalStudenten, $opmerkingen, $uitvoeringsDagEnDatum, $locatieAdresEnPlaatsVanUitvoering, $deadline, $budget, $takenVoorStudenten, $tijd);
    if ( false === $stmt) {
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }
    $stmt->execute();
}
