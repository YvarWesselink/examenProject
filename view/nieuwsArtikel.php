<!DOCTYPE html>
<html lang="en">
<?php

include_once "includes/header.php";

?>
<style>

.artikelposter{
    position: relative;
    overflow: hidden;
    padding: 175px 0 35px;
}

.artikelimg{
    width: 675px;
    height: 500px;
    display: block;
    margin: 0 auto;
    text-align: center;
    border: 3px solid #005A81;
    border-radius: 5px;
}

.artikelcontent{
    position: relative;
    overflow: hidden;
    width: 1000px;
    margin: 0 auto;
}

.artikelcontent h1{
    margin-bottom: 35px;
    font-size: 40px;
    text-align: center;
}

.artikelcontent div,
.artikelcontent p{
    width: 960px;
    word-wrap: break-word;
    padding: 0 21px;
}

</style>
<body>
    <?php

        if(isset($_GET['artikel'])){

        $pdo = self::connect();
        $userID = $_GET['artikel'];

        $st = $pdo->prepare("SELECT * FROM feedback ORDER BY userID");
        $st->execute();
    
        $artikel = $st->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <div class="artikelposter">    
        <img class="artikelimg" src="<?php echo $artikel[$userID]['foto'] ?>" alt="">
    </div>
    <?php
        
        }else{
            echo '<p style="margin: 0 auto; padding-top: 175px; text-align: center; font-weight: bold;">Er is geen artikel om te geven!</p>';
        }

    ?>
    <div class="artikelcontent">
        <h1><?php echo $artikel[$userID]['Name'] ?></h1>
        <div><?php echo $artikel[$userID]['Comments'] ?></div>
    </div>

<?php
include_once "includes/footer.php";
?>
</body>
</html>