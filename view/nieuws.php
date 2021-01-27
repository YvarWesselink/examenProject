<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php";

$conn = self::connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $conn->query("SELECT * FROM images");

?>

<div class="txthome-container">
    <div>
        <div class="txthome-main">
            <h1>Nieuws Uploaden</h1>
            <h3>Hier kunt u de nieuwse nieuwtjes uploaden.</h3>
        </div>
        <div class="txthome-sub">
            <p>Nieuws</p>
        </div>
    </div>

    <div id="signup">
    <form method="post" action="" name="nieuws">
        <label>Naam:</label>
        <input type="text" name="Name" autocomplete="off" />
        <label>Email:</label>
        <input type="text" name="Email" autocomplete="off" />
        <label>Bedrijf</label>
        <input type="text" name="Company" autocomplete="off" />
        <label>Bericht</label>
        <input type="text" name="Comments" autocomplete="off"/>
        <!-- <form method="post" action="" enctype='multipart/form-data' class="upload-image"> -->
        <label>Nieuws foto</label>
        <div class="images" style="text-align: left; display: block;">
            <?php

                if ($result->rowCount() > 0){
                    $row = $result->fetchAll(PDO::FETCH_ASSOC);
                    $count = count($row);
                    $i = 0;
                    $d = 0;
                    
                    while($count > $i){
                        echo "<div style='width: 85px; height: auto; position: relative; overflow: hidden; margin: 0 5px 15px; display: inline-block;'><img src='". $row[$i]['image'] ."' style='width: 100%; height: 85px;border-radius: 3px;'/><span style='display: block; text-align: center;'>" . $row[$i]['id'] . "</span></div>";
                        $i++;
                        }

                        ?>

            <label>Kies foto
                <select name="foto">
                    <option value="0">Geen foto</option>
                    <?php

                        while($count > $d){

                            echo '<option value="' . $row[$d]['image'] . '">foto id ' . $row[$d]['id'] . '</option>';
                            $d++;
                            
                        }

                            echo "<table>";
                        
                        } else {

                            echo "<select name='foto'>Er zijn geen foto's om te kiezen!</select><br>";
                        
                        }

                    ?>
                </select>
            </label>
        </div>
        <label style="display: block;">
            Kies School
            <select name="school">
                <option value="z">Zwolle</option>
                <option value="s">Salland</option>
            </select>
        </label>
        <!-- <input type='submit' value='Upload Plaatje' name='but_upload'> -->
    <!-- </form> -->
        <input type="submit" class="button" name="news" value="Versturen">
    </form>
</div>
    

<!--    in index.php staat op regel 108 de functie die er voor zorgt dat de data naar de database wordt gestuurd (die is nu nog leeg dus moet je zelf even invullen.)-->

</div>

<!--<formmethod="post"action="--><?//phpechohtmlspecialchars($_SERVER["PHP_SELF"]);?><!--"> <br><br><br><br><br><br><br>-->
<!--  Volledige naam: <inputtype="text"name="name"required>-->
<!--<br><br>-->
<!--  Email Adres: <inputtype="text"name="email"required>-->
<!--<br><br>-->
<!--  Bedrijfsnaam*: <inputtype="text"name="company">-->
<!--<br><br>-->
<!--  Bericht: <textareaname="comments"rows="5"cols="40"required></textarea>-->
<!--<br><br>-->
<!--<inputtype="submit"name="submit"value="Submit">-->
<!--</form>-->

</html>
