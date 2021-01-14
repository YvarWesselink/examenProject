<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php";
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
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachten");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th> </th><th>Id</th><th>Opdracht</th><th>Status</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";
    
    while($count > $i){
      $project_id = $row[$i]['project_id'];
      echo "<tr>";
      // echo "<td><a href='' name='edit' style='cursor: pointer; text-decoration: none;' class='fa fa-edit editBtn'> Wijzigen</a></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRow'> Verwijderen</button></td>";
      echo "<td id='id'>". $row[$i]['project_id'] ."</td>";
      echo "<td>". $row[$i]['Opdracht'] ."</td>";
      echo "<td>". $row[$i]['FormStatus'] ."</td>";
      echo "<td>". $row[$i]['Opmerkingen'] ."</td>";
      echo "<td>". $row[$i]['AantalStudenten'] ."</td>";
      echo "<td>". $row[$i]['UitvoeringsDagEnDatum'] ."</td>";
      echo "</tr>";
      // echo "<div class='main-content'>";
      // echo "<div class='deleteAndId'> <button type='submit' class='fa fa-trash deleteBtn deleteTableRow'> Verwijderen</button> " .$row[$i]['project_id']. "</div>" .$row[$i]['Opdracht']. " " .$row[$i]['FormStatus']. " " .$row[$i]['Opmerkingen']. " " .$row[$i]['AantalStudenten']. " " .$row[$i]['UitvoeringsDagEnDatum']."";
      // echo "</div>";
      echo "<div class='deleteAndId'> <button type='submit' class='fa fa-trash deleteBtn deleteTableRow'></button> " .$row[$i]['project_id']. "</div>";
      $i ++;
    }
    echo "<table>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div>";
  }
?>

</html>
<?php
  // include_once "includes/footer.php";
?>

<script>
  $('.deleteTableRow').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).parent('div').text().slice(-2);
          // var id = "<?php echo $project_id; ?>";
          console.log(id);
          console.log('test');
          $.ajax({
              url: '/deleteRowExc',
              data: {'id' : id},
              type: 'GET'
          })
          $(document).delegate('button', 'click', function () {
            $(this).parent('div').remove();
            // id.remove();
          })
          // location.reload();
      } else {
          console.log("niet verwijderd");
      }
  })
</script>

<style>
table {
  border-collapse: collapse;
  width: 90%;
  border-radius: 5px;
  margin-left: 5vw;
  box-shadow: 5px 5px 10px darkgrey;
}

.main-content {
  width: 90%;
  margin-left: 5vw;
  padding: 8px;
  text-align: center;
  box-shadow: 5px 5px 10px darkgrey;
}

/* .deleteAndId {
  margin-left: -75vw;
} */

.deleteBtn {
  background-color: transparent;
  border: none;
  cursor: pointer;
  color: red;
}

.editBtn {
  color: green;
}

th, td {
  padding: 8px;
}

tr:nth-child(even){background-color: #f8a0bd}

th {
  background-color: #ffffff;
  color: #005a81;
}

tr

</style>