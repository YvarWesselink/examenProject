<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php";
if (empty($_SESSION['username'])) {
    header('Location: index.php');
    $username = $_SESSION['username'];
}

//-------------< user level check functie  >-----------------|
//haalt user level op uit admin                            //|
// < 5 alleen admins kunnen op deze pagina                 //|
// < 4 betekend dat docenten en admins op pagina kunnen    //|
// < 3 studenten en meer kunnen op deze pagina             //|
// < 2 gasten kunnen de pagina bekijken                    //|
// < 1 alleen een geldig acount kan deze pagina zien       //|
if($_SESSION['user_lv'] < 0){                              //|
    header('Location: index.php');                         //|
}                                                          //|
//-----------------------------------------------------------|
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
<!-- Get all data from db for the excersises -->
<?php 
if($_SESSION['user_lv'] == 5){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachtens");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten Salland</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";

    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-opdracht'><button type='submit' value='' name='editBtn' class='fa fa-edit editBtn'/><input type='hidden' name='project_id' value=". $row[$i]['id'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRow' id=". $row[$i]['id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['id'] ."</td>";
        if (isset($row[$i]['Opdracht'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Opmerkingen'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Aantal_studenten'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Uitvoerings_dag_en_datum'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
      echo "</tr>";
      $i ++;
    }
    echo "<table><br><br>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div><br>";
  }
}
?>
<?php
if($_SESSION['user_lv'] == 5){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachtenz");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten Zwolle</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";

    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-opdracht-zwolle'><button type='submit' value='' name='editBtnZ' class='fa fa-edit editBtn'/><input type='hidden' name='project_id' value=". $row[$i]['id'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRowZ' id=". $row[$i]['id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['id'] ."</td>";
        if (isset($row[$i]['Opdracht'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Opmerkingen'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Aantal_studenten'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Uitvoerings_dag_en_datum'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
      echo "</tr>";
      $i ++;
    }
    echo "<table><br><br>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div><br>";
  }
}
?>
<?php
if($_SESSION['user_lv'] == 5){
?>
<a href="/oude-opdrachten" class="oldExcBtn">Oude opdrachten</a><br>
<?php
}
?>

<!-- Get all data from db for the users -->
<?php 
if($_SESSION['user_lv'] == 5){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM users");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<br><br><div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Gebruikers</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Gebuikersnaam</th><th>Voornaam</th><th>Achternaam</th><th>E-mail</th>";
    
    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-gebruiker'><button type='submit' value='' name='editBtn' class='fa fa-edit editBtn'/><input type='hidden' name='uid' value=". $row[$i]['uid'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRowUser' id=". $row[$i]['uid'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['username'] ."</td>";
      echo "<td>". $row[$i]['voornaam'] ."</td>";
      echo "<td>". $row[$i]['achternaam'] ."</td>";
      echo "<td>". $row[$i]['email'] ."</td>";
      echo "</tr>";
      $i ++;
    }
    echo "<table>";
    } else {
    echo "<div>* Er zijn nog geen gebruikers.</div>";
  }
}
?>

<!-- Get all data from db for the news -->
<?php 
if($_SESSION['user_lv'] == 5){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM feedback");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<br><br><div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Nieuws</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Naam</th><th>E-mail</th><th>Bedrijf</th><th>Opmerkingen</th><th>Foto</th><th>School</th>";
    
    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-nieuws'><button type='submit' value='' name='editBtn' class='fa fa-edit editBtn'/><input type='hidden' name='userID' value=". $row[$i]['userID'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRowNews' id=". $row[$i]['userID'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['Name'] ."</td>";
      echo "<td>". $row[$i]['Email'] ."</td>";
      echo "<td>". $row[$i]['Company'] ."</td>";
      echo "<td>". $row[$i]['Comments'] ."</td>";
      if($row[$i]['foto'] !== '0'){echo "<td><img src='". $row[$i]['foto'] ."' style='width: 50px; height: 50px; position: relative; overflow: hidden; border-radius: 3px;' alt='Geen foto'/></td>";}else{echo '<td>Geen foto</td>';}
      echo "<td>". $row[$i]['school'] ."</td>";
      echo "</tr>";
      $i ++;
    }
    echo "<table>";
    } else {
    echo "<div>* Er is nog geen nieuws.</div><br>";
  }
}
?>
<br>
<br>
<!-- Get all data from db for the excersises -->
<?php 
if($_SESSION['user_lv'] == 3){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachtens");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten Salland</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";

    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-opdracht'><button type='submit' value='Bekijk' name='editBtn' class='editBtn'>Bekijk</button><input type='hidden' name='project_id' value=". $row[$i]['id'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRow' id=". $row[$i]['id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['id'] ."</td>";
      echo "<td>". $row[$i]['Opdracht'] ."</td>";
      echo "<td>". $row[$i]['Opmerkingen'] ."</td>";
      echo "<td>". $row[$i]['Aantal_studenten'] ."</td>";
      echo "<td>". $row[$i]['Uitvoerings_dag_en_datum'] ."</td>";
      echo "</tr>";
      $i ++;
    }
    echo "<table><br><br>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div><br>";
  }
}
?>
<?php
if($_SESSION['user_lv'] == 3){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachtenz");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten Zwolle</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";

    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-opdracht-zwolle'><button type='submit' value='' name='editBtnZ' class='editBtn'>Bekijk</button><input type='hidden' name='project_id' value=". $row[$i]['id'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRowZ' id=". $row[$i]['id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['id'] ."</td>";
        if (isset($row[$i]['Opdracht'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Opmerkingen'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Aantal_studenten'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Uitvoerings_dag_en_datum'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
      echo "</tr>";
      $i ++;
    }
    echo "<table><br><br>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div><br>";
  }
}
?>
<?php
if($_SESSION['user_lv'] == 3){
?>
<a href="/oude-opdrachten" class="oldExcBtn">Oude opdrachten</a><br>
<?php
}
?>
<br>
<br>
<!-- Get all data from db for the excersises -->
<?php 
if($_SESSION['user_lv'] == 2){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachtens");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten Salland</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";

    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-opdracht'><button type='submit' value='' name='editBtn' class='fa fa-edit editBtn'/><input type='hidden' name='project_id' value=". $row[$i]['id'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRow' id=". $row[$i]['id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['id'] ."</td>";
      echo "<td>". $row[$i]['Opdracht'] ."</td>";
      echo "<td>". $row[$i]['Opmerkingen'] ."</td>";
      echo "<td>". $row[$i]['Aantal_studenten'] ."</td>";
      echo "<td>". $row[$i]['Uitvoerings_dag_en_datum'] ."</td>";
      echo "</tr>";
      $i ++;
    }
    echo "<table><br><br>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div><br>";
  }
}
?>
<?php
if($_SESSION['user_lv'] == 2){
  $conn = self::connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $result = $conn->query("SELECT * FROM projectenopdrachtenz");
  if ($result->rowCount() > 0){
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);
    $i = 0;
    echo "<div style='border-top-right-radius: 5px; border-top-left-radius:5px; box-shadow: 5px 5px 10px darkgrey; background-color: #ed135d; padding: 10px; width: 90%; margin-left: 5vw;'><h2 style='color: #ffffff;'>Opdrachten Zwolle</h2></div>";
    echo "<table  style='text-align: center;'>";
    echo "<th></th><th></th><th>Id</th><th>Opdracht</th><th>Opmerkingen</th><th>Aantal Studenten</th><th>Uitvoeringsdatum</th>";

    while($count > $i){
      echo "<tr>";
      echo "<td><form method='post' action='/update-opdracht-zwolle'><button type='submit' value='' name='editBtnZ' class='fa fa-edit editBtn'/><input type='hidden' name='project_id' value=". $row[$i]['id'] ." /> </form></td>";
      echo "<td><button type='submit' class='fa fa-trash deleteBtn deleteTableRowZ' id=". $row[$i]['id'] ."></button></td>";
      echo "<td id='id'>". $row[$i]['id'] ."</td>";
        if (isset($row[$i]['Opdracht'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Opmerkingen'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Aantal_studenten'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
        if (isset($row[$i]['Uitvoerings_dag_en_datum'])) {echo "<td>". $row[$i]['Opdracht'] ."</td>";}
      echo "</tr>";
      $i ++;
    }
    echo "<table><br><br>";
    } else {
    echo "<div>* Er zijn nog geen opdrachten.</div><br>";
  }
}
?>
<?php
if($_SESSION['user_lv'] == 2){
?>
<a href="/oude-opdrachten" class="oldExcBtn">Oude opdrachten</a><br>
<?php
}
?>
<br>
<br>
</html>
<?php
  include_once "includes/footer.php";
?>

<form method="post">
    <input type="hidden" value="$id">
    <input type="submit" value="edit">
</form>

<!-- Delete function for the excersise table salland-->
<script>
  $('.deleteTableRow').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          $.ajax({
              url: '/deleteRowExc',
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

<!-- Delete function for the excersise table zwolle-->
<script>
  $('.deleteTableRowZ').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          $.ajax({
              url: '/deleteRowExcZ',
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

<!-- Edit function for the excersise table -->
<!-- <script>
  $('.editExcersise').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens wilt aanpassen?")) {
          var id = $(this).attr('id');
          console.log(id);
          $.ajax({
              url: '/editExcersise',
              data: {'id' : id},
              type: 'GET'
          })
          window.location.replace("/update-opdracht");
      } else {
          console.log("niet aanpassen");
      }
  })
</script> -->

<!-- Delete function for the users table -->
<script>
  $('.deleteTableRowUser').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          console.log(id);
          $.ajax({
              url: '/deleteRowUser',
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

<!-- Edit function for the users table -->
<script>
  $('.editUser').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          console.log(id);
      //     $.ajax({
      //         url: '/deleteRowUser',
      //         data: {'id' : id},
      //         type: 'GET'
      //     })
      //     $(document).delegate('button', 'click', function () {
      //       $(this).parent('div').remove();
      //     })
      //     location.reload();
      } else {
          console.log("niet verwijderd");
      }
  })
</script>

<!-- Delete function for the news table -->
<script>
  $('.deleteTableRowNews').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          console.log(id);
          $.ajax({
              url: '/deleteRowNews',
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


<!-- Edit function for the news table -->
<script>
  $('.editNews').click(function () {
      if (confirm("Weet je zeker dat je deze gegevens uit de database wilt verwijderen? Dit kan je niet ongedaan maken!")) {
          var id = $(this).attr('id');
          console.log(id);
          // $.ajax({
          //     url: '/deleteRowNews',
          //     data: {'id' : id},
          //     type: 'GET'
          // })
          // $(document).delegate('button', 'click', function () {
          //   $(this).parent('div').remove();
          // })
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

.oldExcBtn {
  margin-left: 5vw;
  background-color: #ed135d;
  padding: 1vh;
  border-radius: 25px;
  box-shadow: 5px 5px 10px darkgrey;
  text-decoration: none;
  color: white;
}
</style>