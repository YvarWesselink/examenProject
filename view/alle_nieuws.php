<!DOCTYPE html>
<html>
<head>
<title>Alle nieuws artikelen</title>
<link rel="stylesheet" href="nieuws.css">

</head>
<body>

<?php
$sql = "SELECT userID, Name, Email, Comments FROM feedback";
$result = $pdo->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo '<div class="nieuws"><td><br>' . $row["userID"]. "</td><td><br>" . $row["Name"] . "</td><td><br>"
. $row["Email"]. "</td><td><br>" . $row["Comments"]. "</td><br><br></div>";
}
echo "</table>";
} else { echo "0 results"; }
$pdo->close();
?>

</body>
</html>