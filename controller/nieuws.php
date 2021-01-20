<?php

class nieuws extends controller
{

    public static function UploadNews($name, $email, $company, $comments) {

  $name = $email = $company = $comments = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {​​​​​​​​
  $conn = database::connect();
  

  $stmt = $conn->prepare("INSERTINTO feedback (Name,Email,Company,Comments) VALUES (:name, :email, :company, :comments)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':company', $company);
  $stmt->bindParam(':comments', $comments);

 $name = ($_POST["name"]);
 $email = ($_POST["email"]);
 $company = ($_POST["company"]);
 $comments = ($_POST["comments"]);
 $stmt->execute();

  echo"<div style='color:navy;'><h2>We hebben het volgende bericht van u ontvangen::</h2>";
  echo"Uw naam: ".$name;
  echo"<br>";
  echo"Uw email adres: ".$email;
  echo"<br>";
  echo"Uw bedrijf: ".$company;
  echo"<br>";
  echo"Uw bericht: ".$comments;
  echo"<br>";
  echo"<h2>We zullen er zo snel mogelijk naar kijken!</h2></div>";

  }​​​​​​​​

  functionclean($userInput) {​​​​​​​​
  $userInput = trim($userInput);
  $userInput = stripslashes($userInput);
  $userInput = htmlspecialchars($userInput);
  return$userInput;
    }​​​​​​
  $conn = null;

  ?>

}

}
