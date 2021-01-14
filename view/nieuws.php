<?PHP

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

<?php
$name = $email = $company = $comments = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {​​​​​​​​
try {​​​​​​​​
$conn = newPDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("INSERTINTO feedback (Name,Email,Company,Comments) VALUES (:name, :email, :company, :comments)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':company', $company);
$stmt->bindParam(':comments', $comments);

$name = clean($_POST["name"]);
$email = clean($_POST["email"]);
$company = clean($_POST["company"]);
$comments = clean($_POST["comments"]);
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
catch(PDOException$e)
{​​​​​​​​
echo"Error: ".$e->getMessage();
}​​​​​​​​
}​​​​​​​​

functionclean($userInput) {​​​​​​​​
$userInput = trim($userInput);
$userInput = stripslashes($userInput);
$userInput = htmlspecialchars($userInput);
return$userInput;
  }​​​​​​​​
$conn = null;

?>
