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
<!-- Get all data from db for the users -->
<?php 
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM oudeopdrachten ORDER BY `project_id` DESC");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<br><br><div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Gebruikers</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal studenten</th><th>Uitvoerings dag en datum</th>";
    
    while($count > $i){
      echo "<tr>";
      echo "<td><button type='submit' class='fa fa-edit editBtn deleteTableRowOldExc' id=". $row[$i]['project_id'] ."></button></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRowOldExc' id=". $row[$i]['project_id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['project_id'] ."</td>";
      echo "<td>". $row[$i]['Opdracht'] ."</td>";
      echo "<td>". $row[$i]['Opmerkingen'] ."</td>";
      echo "<td>". $row[$i]['Aantal studenten'] ."</td>";
      echo "<td>". $row[$i]['Uitvoerings dag en datum'] ."</td>";
      echo "</tr>";
      $i ++;
    }
    echo "<table>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div>";
  }
?>

<br>
<br>
</html>
<?php
  include_once "includes/footer.php";
?>

<!-- Delete function for the users table -->
<script>
  $('.deleteTableRowOldExc').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          console.log(id);
          $.ajax({
              url: '/deleteRowOldExc',
              data: {'id' : id},
              type: 'GET'
          })
          $(document).delegate('button', 'click', function () {
            $(this).parent('div').remove();
          })
          location.reload();
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

.deleteBtn {
  background-color: transparent;
  border: none;
  cursor: pointer;
  color: red;
  font-size: 22px !important;
}

.editBtn {
  background-color: transparent;
  border: none;
  cursor: pointer;
  color: green;
  font-size: 22px !important;
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