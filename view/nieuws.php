<!DOCTYPE html>
<html lang="en">

<?php
include_once "includes/header.php"
?>

<h2>Nieuws</h2>
<formmethod="post"action="<?phpechohtmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
