<?PHP 
include 'includes/db.php';
?>

<h2>Nieuws</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Volledige naam: <input type="text" name="name" required>
  <br><br>
  Email Adres: <input type="text" name="email" required>
  <br><br>
  Bedrijfsnaam*: <input type="text" name="company">
  <br><br>
  Bericht: <textarea name="comments" rows="5" cols="40" required></textarea>
  <br><br>
  <input type="submit" name="submit" value="Submit">
</form>

<?php
$name = $email = $company = $comments = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO feedback (Name,Email,Company,Comments) VALUES (:name, :email, :company, :comments)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':company', $company);
    $stmt->bindParam(':comments', $comments);

    $name = clean($_POST["name"]);
    $email = clean($_POST["email"]);
    $company = clean($_POST["company"]);
    $comments = clean($_POST["comments"]);
    $stmt->execute();

    echo "<div style='color:navy;'><h2>We hebben het volgende bericht van u ontvangen::</h2>";
    echo "Uw naam: ". $name;
    echo "<br>";
    echo "Uw email adres: " . $email;
    echo "<br>";
    echo "Uw bedrijf: ". $company;
    echo "<br>";
    echo "Uw bericht: " . $comments;
    echo "<br>";
    echo "<h2>We zullen er zo snel mogelijk naar kijken!</h2></div>";

}
catch(PDOException $e)
{
echo "Error: " . $e->getMessage();
}
}

function clean($userInput) {
    $userInput = trim($userInput);
    $userInput = stripslashes($userInput);
    $userInput = htmlspecialchars($userInput);
    return $userInput;
  }
  $conn = null;
  
  ?>
  
  