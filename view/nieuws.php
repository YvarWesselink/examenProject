<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<formmethod="post"action="<?phpechohtmlspecialchars($_SERVER["PHP_SELF"]);?>"> <br><br><br><br><br><br><br>
  Volledige naam: <inputtype="text"name="name"required>
<br><br>
  Email Adres: <inputtype="text"name="email"required>
<br><br>
  Bedrijfsnaam*: <inputtype="text"name="company">
<br><br>
  Bericht: <textareaname="comments"rows="5"cols="40"required></textarea>
<br><br>
<inputtype="submit"name="submit"value="Submit">
</form>
