<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<!-- Start Banner Section -->
<section class="banner">
    <div class="banner-img" style="height: 400px"></div>
    <div class="banner-svg">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1"
                  d="M0,96L80,112C160,128,320,160,480,154.7C640,149,800,107,960,90.7C1120,75,1280,85,1360,90.7L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,128L120,112C240,96,480,64,720,64C960,64,1200,96,1320,112L1440,128L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg> -->
    </div>
</section>
<div class="clearfix"></div>
<!-- End Banner Section -->
<?php
echo "<div style='box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten</h2></div>";
echo "<table style=''>";
echo "<tr><th>Id</th><th>Opdracht</th><th>Status</th><th>Opmerking</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:250px;border:0px solid black; text-align: center;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "praktijkplaza";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT project_id, Opdracht, FormStatus, Opmerkingen, AantalStudenten, UitvoeringsDagEnDatum FROM projectenopdrachten");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
<br>
<br>
<?php
include_once "includes/footer.php";
?>

</html>

<style>
table {
  border-collapse: collapse;
  width: 90%;
  border-radius: 5px;
  margin-left: 5vw;
  box-shadow: 5px 5px 10px darkgrey;
}

th, td {
  padding: 8px;
}

tr:nth-child(even){background-color: #f8a0bd}

th {
  background-color: #ffffff;
  color: #005a81;
}
</style>