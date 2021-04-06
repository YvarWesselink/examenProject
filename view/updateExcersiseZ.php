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

<div class="txthome-container opdracht">
    <div class="txthome-main">
        <h1>Opdrachten updaten</h1>
        <h3>*hier moet nog een tekstje komen.*</h3>
    </div>
    <!-- Dit is het form waar je de opdracht in kunt vullen. -->
    <div id="printableTable">
    <div class="txthome-sub">
        <p>1 Opdracht </p>
    </div>
    <form method="post" class="opdrachtIndienenForm" id="null">
        <div>
            <?php
            $errormsg = "";
            if (isset($_POST['updateExcersiseZ'])) {
                $errormsg = updateExcersiseZ::checkExcersiseZ($_POST);

                if (!array_filter($errormsg)) {
                    updateExcersiseZ::UploadExersiseZ($_POST);
                }
            }
            updateExcersiseZ::showFieldsZ($errormsg);
            ?>
            <!-- Dit is het form voor de gegevens van het bedrijf. -->
            <?php
            if($_SESSION['user_lv'] == 5){                              
                ?>
            <input type="submit" class="sendExcersiseBtn" name="updateExcersiseZ" value="Opdracht updaten">
            <?php
                }                              
                ?>
        </div>
    </form>
    </div>
    <button class="Button Button--outline sendExcersiseBtn" onclick="printDiv()">Print</button>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
</div>
</html>

<script type="text/javascript">
    function printDiv() {
        window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
</script>

<style>
@media print {
  * {
    display: none;
  }
  #printableTable {
    display: block;
  }
}</style>