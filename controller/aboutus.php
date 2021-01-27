<?php

class aboutus extends controller {
    // Schrijf hier je functies

    public static function test() {
        $test = self::query("SELECT * FROM users");
        $_SESSION['user'] = $test;
        // voorbeeld
        // bij elke refresh komt er een nieuwe user in de database met de username tester.

//        self::query("INSERT INTO users(id, username, email, password) VALUES ('','tester','test@gmail.com','12345') ");
    }
    public static function downloadnieuws() {
        $conn = self::connect();
$sql = "SELECT userID, Name, Email, Comments FROM feedback";
$conn->prepare($sql);
$conn->execute();
$result = $conn->fetchAll(PDO::FETCH_ASSOC);
print_r($result);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo '<div class="nieuws"><td><br>' . $row["userID"]. "</td><td><br>" . $row["Name"] . "</td><td><br>"
. $row["Email"]. "</td><td><br>" . $row["Comments"]. "</td><br><br></div>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();

    }
}